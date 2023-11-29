@extends('layouts.main')

@section('title', 'Calculator')

@push('scripts')
    <script>
        jQuery(document).ready(function($) {
            // show output if there is a query
            var $pre = $('pre[data-ahproxy-output]');
            var url = window.location.href;
            if (url.indexOf('?') != -1) {
                console.log("show");
                $pre.show();
            } else {
                console.log("hide");
                $pre.hide();
            }
        });
    </script>
    <script>
        var example_eqn = new Array('2(x+1)+x(x+1)+2x^2', '12x + 3 + x + -1 - 5x', '12x^2y^3 + 5x^2y^2 + 7x^2y^2 - 3x^2y^3',
            '2 * 3 + 2 * 6x + 4');
        var i = Math.floor(Math.random() * example_eqn.length);

        function example() {
            var form = document.getElementById('calcForm')
            form.expression.value = example_eqn[i];
            i += 1;
            if (i >= example_eqn.length)
                i = 0;
        }
    </script>
    <script>
        (function() {
            var PROXY_URL_TAG = "data-ahproxy-url";
            var INPUT_TAG = "data-ahproxy-input";
            var ERRORS_TAG = "data-ahproxy-errors";
            var OUTPUT_TAG = "data-ahproxy-output";
            var SUBMIT_TAG = "data-ahproxy-submit";
            var UNKNOWN_ERROR_MESSAGE = "Oh no!  There was an unexpected error running your calculation.";

            /**
             * Check to see if an element has an attribute, without the risk of throwing an exception.
             *
             * @param {Node} element - The Node (not necessarily HTML element) to check.
             * @param {string} attribute - The attribute to check, like "data-id" or "style".
             *
             * @returns {boolean}
             */
            function has(element, attribute) {
                return element.nodeType === 1 && element.hasAttribute(attribute);
            }

            /**
             * Recursively find all the elements belonging to our calculator.
             *
             * @param {Node} root - The root element to check (like `document`).
             * @param {Object} result - The returned object containing our elements.
             *
             * @returns {Object}
             */
            function findElements(root, result) {
                if (!result) {
                    result = {
                        proxyURL: null,
                        inputs: [],
                        errors: null,
                        output: null,
                        submit: null,
                    };
                }

                var children = root.childNodes;

                for (var i = 0; i < children.length; i++) {
                    var child = children[i];

                    if (has(child, PROXY_URL_TAG)) {
                        result.proxyURL = child.getAttribute(PROXY_URL_TAG);
                    }

                    if (has(child, INPUT_TAG)) {
                        result.inputs.push(child);
                    }

                    if (has(child, ERRORS_TAG)) {
                        result.errors = child;
                    }

                    if (has(child, OUTPUT_TAG)) {
                        result.output = child;
                    }

                    if (has(child, SUBMIT_TAG)) {
                        result.submit = child;
                    }

                    result = findElements(child, result);
                }

                return result;
            }

            /**
             * Ensure that all the elements exist on the page.
             *
             * @param {Object} result - The object containing our elements.
             *
             * @returns {Array} - All the validation errors.
             */
            function validateElements(result) {
                var errorMessages = [];

                if (!result.proxyURL) {
                    errorMessages.push("Missing " + PROXY_URL_TAG + " element.");
                }

                if (!result.errors) {
                    errorMessages.push("Missing " + ERRORS_TAG + " element.");
                }

                if (!result.output) {
                    errorMessages.push("Missing " + OUTPUT_TAG + " element.");
                }

                if (!result.submit) {
                    errorMessages.push("Missing " + SUBMIT_TAG + " element.");
                }

                if (result.inputs.length === 0) {
                    errorMessages.push("Missing " + INPUT_TAG + " element(s).");
                }

                return errorMessages;
            }

            /**
             * Remove children from an HTML element.
             *
             * @param {Node} element - The parent element to clear.
             */
            function clear(element) {
                if (element && element.childNodes) {
                    for (var i = 0; i < element.childNodes.length; i++) {
                        element.removeChild(element.childNodes[i]);
                    }
                }
            }

            function toQueryParams(inputs) {
                var query = [];

                for (var i = 0; i < inputs.length; i++) {
                    var input = inputs[i];

                    var shouldInsert = (input.nodeName == "SELECT" && input.value) || (input.nodeName == "INPUT" && (
                        input.type == "text" || (input.type == "checkbox" && input.checked) || (input.type ==
                            "radio" && input.checked)));

                    if (shouldInsert) {
                        var value = encodeURIComponent(input.value);
                        // algebrahelp.com did some weird things with query string encoding.  They encoded spaces as + after calling encodeURIComponent.  It makes no sense but we have to copy their behavior if we want existing links to work.
                        if (input.name === "equation") {
                            value = value.replace(/%20/g, "+");
                        }

                        query.push(encodeURIComponent(input.name) + "=" + value);
                    }
                }

                return "?" + query.join("&")
            }

            /**
             * Send a request to the AlgebraHelp proxy.
             *
             * @param {string} proxyURL - The URL where the proxy lives.
             * @param {array} inputs - The array of inputs to use when making the request.
             * @param {Node} errors - The HTML element where we will display any (expected) errors.
             * @param {Node} output - The HTML element where we will display our output.
             */
            function calculate(proxyURL, inputs, errors, output) {
                // Remove the errors and output of the any old runs of the calculator.
                clear(output);
                clear(errors);

                // Make an XHR request.
                var request = new XMLHttpRequest();

                request.open("GET", proxyURL + toQueryParams(inputs));

                request.addEventListener("load", function() {
                    if (request.status === 200) {
                        var html = JSON.parse(request.responseText)["output"];
                        html = html.replaceAll('<' + 'img src="/images/black.gif" width="100%" height="2">',
                            '<hr class="slash">');
                        output.innerHTML = html;
                    } else if (request.status === 400) {
                        var body = JSON.parse(request.responseText);
                        var ul = document.createElement("ul");

                        for (var i = 0; i < body["errors"].length; i++) {
                            var li = document.createElement("li");

                            li.innerHTML = body["errors"][i];

                            ul.appendChild(li);
                        }

                        errors.appendChild(ul);
                    } else if (request.status === 500 || request.status === 403) {
                        console.error(JSON.parse(request.responseText));

                        errors.innerHTML = UNKNOWN_ERROR_MESSAGE;
                    } else {
                        console.error(request);

                        errors.innerHTML = UNKNOWN_ERROR_MESSAGE;
                    }
                });

                request.addEventListener("error", function() {
                    console.error("Cannot parse this error.  Request details below:");
                    console.error(request);

                    errors.innerHTML = UNKNOWN_ERROR_MESSAGE;
                });

                request.send();
            }

            /**
             * Parse the query parameters for the given window.
             *
             * @returns {Object<String, String>} The query parameters.
             */
            function getQueryParams() {
                var rawQuery = window.location.search;

                if (rawQuery === "") {
                    return {};
                }

                // Remove leading ? and split on &.
                var rawQueryParams = rawQuery.substr(1).split("&");
                var result = {};

                for (var i = 0; i < rawQueryParams.length; i++) {
                    var pair = rawQueryParams[i].split("=");
                    // algebrahelp.com did some weird things with query string encoding.  They encoded spaces as + after calling encodeURIComponent.  It makes no sense but we have to copy their behavior if we want existing links to work.
                    result[decodeURIComponent(pair[0])] = decodeURIComponent(pair[1].replace(/ +/g, "%20"));
                }

                return result;
            }

            /**
             * Set up the page.
             */
            function main() {
                var result = findElements(document);
                var errorMessages = validateElements(result);

                if (errorMessages.length > 0) {
                    console.error(errorMessages.join("n"));

                    return;
                }

                query = getQueryParams();

                // Inject the equation/expression into the title/h1 of the page, if any exists.
                var statement;
                var terms = ["equation", "expression"];

                for (var i = 0; i < terms.length; i++) {
                    statement = query[terms[i]];
                    if (statement) {
                        // Set the title/h1.
                        document.title = statement + " | " + (document.title || "");

                        // Resources pages place content in a div with an id of lessonArticleBody.
                        var articleBody = document.getElementById("lessonArticleBody");

                        for (var j = 0; j < articleBody.children.length; j++) {
                            var child = articleBody.children[j];

                            if (child.nodeName === "H1") {
                                child.innerHTML = statement;

                                // There shouldn't be more than one <h1> tag, but let's program defensively.
                                break;
                            }
                        }

                        // Break.  We just use the first term given, whether it's expression or equation.
                        break;
                    }
                }

                // Populate inputs with the value from the query string parameters.
                for (var i = 0; i < result.inputs.length; i++) {
                    var input = result.inputs[i];
                    var value = query[input.name];

                    if (value) {
                        if (input.type === "checkbox") {
                            // The checkbox should be checked if the value from the query string matches the value defined on the element.
                            input.checked = value === input.value;
                        } else {
                            input.value = value;
                        }
                    }
                }

                // If there are any query string parameters, attempt to run the calculator with them first.
                var hasQuery = false;

                for (var prop in query) {
                    if (query.hasOwnProperty(prop)) {
                        hasQuery = true;

                        break;
                    }
                }

                if (hasQuery) {
                    calculate(result.proxyURL, result.inputs, result.errors, result.output);
                }

                // Run the calculator when we ask.
                result.submit.onclick = function(event) {
                    event.preventDefault();

                    window.location.replace(window.location.origin + window.location.pathname + toQueryParams(result
                        .inputs));
                }
            }

            // Go!
            document.addEventListener("DOMContentLoaded", main, false);
        })();
    </script>
@endpush

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible mb-3" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            {{-- <form action="{{ route('calculator.simple_store') }}" method="POST"> --}}
            <div class="row">
                <div id="lessonArticleBody" class="desc" itemprop="articleBody">
                    <h1></h1>
                    <form name="expressionForm" method="get"
                        data-ahproxy-url="https://www.ixl.com/algebrahelp/expression/oops/calc" id="calcForm">
                        <div>
                            <table>
                                <tbody>
                                    <tr class="labels">
                                        <td>Expression:</td>
                                        <td>&nbsp;</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input data-ahproxy-input="" type="text" class="form-control" name="expression" size="35"
                                                value="">
                                            </td>
                                        <td>
                                            <input data-ahproxy-submit="" class="btn btn-sm btn-primary" type="submit" value="SIMPLIFY">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </form>
                    <hr>
                    <pre data-ahproxy-output="" data-ahproxy-errors=""></pre>
                </div>
            </div>

        </div>
    </div>
@endsection
