let my = {};
function init() {
    let version = "";
    let w = 600;
    let h = 320;
    my.opts = { nStt: 1, nEnd: 10, func: "n^2" };
    let s = "";
    s += wrap(
        { style: "text-align: right; z-index:3;" },
        wrap(
            { cls: "", style: "left:5px; bottom:3px" },
            `${version}`
        ),
    );
    s += getPopHTML();
    s += wrap(
        { style: " text-align:left; margin-top:-25px;" },
        wrap({
            id: "nEnd",
            tag: "inp",
            pos: "abs",
            style: "left:27px; top:7px; width:40px; z-index:3;",
            fn: "update()",
        }),
        wrap(
            {
                pos: "abs",
                style: "left:30px; top:22px; font: 80px Serif; pointer-events: none;",
            },
            "&Sigma;"
        ),
        wrap({ pos: "abs", style: "left:5px; top:100px; " }, "n="),
        wrap({
            id: "nStt",
            tag: "inp",
            pos: "abs",
            style: "left:27px; top:98px; width:40px; z-index:3;",
            fn: "update()",
        }),
        wrap(
            {
                id: "q",
                tag: "edit",
                pos: "rel",
                style: "margin:0 0 60px 90px; top:40px; width:460px; height:50px; font: 22px Arial;",
                fn: "update()",
            },
            "n^2"
        )
    );
    s += wrap(
        { style: "margin-left:95px;" },
        '<span style="font: bold 20px Arial; vertical-align:top;" >= </span>',
        wrap({
            id: "calc",
            tag: "edit",
            style: "width:430px; height:120px;font: 16px Arial; ",
        }),
        "<br>",
        '<span style="font: bold 20px Arial; " >= </span>',
        wrap({ id: "a", tag: "out", style: "width:430px;" })
    );
    s = wrap({ cls: "js", style: "width:560px" }, s);
    docInsert(s);
    document.getElementById("nStt").value = optGet("nStt");
    document.getElementById("nEnd").value = optGet("nEnd");
    document.getElementById("q").value = optGet("func");
    my.hists = [];
    my.lastHist = "?";
    my.lastHistTime = 0;
    my.exs = [
        ["1/2^n", 1, 10],
        ["(-1)^n/n", 1, 10],
        ["1/n!", 0, 10],
        ["n/(n+1)-(n-1)/n", 1, 10],
        ["cos(pi*n/10)", 1, 10],
        ["1/n", 1, 10],
        ["1/n^2", 1, 10],
        ["e^(1/n)", 1, 10],
    ];
    my.exNo = 0;
    my.parser = new Parser();
    this.radsQ = false;
    let testFun = "6+2*n!-77!";
    update();
}
function getPopHTML() {
    let s = "";
    s +=
        '<div id="histpop" style="position:absolute; left:-450px; top:50px; width:460px; padding: 5px; background-color:hsla(240,50%,80%,0.9); border: 1px solid red; border-radius: 9px; box-shadow: 10px 10px 5px 0px rgba(40,40,40,0.75); z-index:1; transition: all linear 0.3s; opacity:0; ">';
    s += wrap(
        {
            id: "histbox",
            tag: "edit",
            pos: "rel",
            style: "width: 400px; height: 120px; font: 16px Arial;",
        },
        ""
    );
    s += '<div style="float:right; margin: 0 0 5px 10px;">';
    s +=
        '<button onclick="editYes()" style="z-index:2; font: 22px Arial;" class="btn" >&#x2714;</button>';
    s += "</div>";
    s += "</div>";
    return s;
}
function doExample() {
    my.exNo = ++my.exNo % my.exs.length;
    let ex = my.exs[my.exNo];
    document.getElementById("q").value = ex[0];
    document.getElementById("nStt").value = ex[1];
    document.getElementById("nEnd").value = ex[2];
    update();
}
function getHist() {
    let s = "";
    my.lastHistTime = 0;
    update();
    for (let i = 0; i < my.hists.length; i++) {
        s += my.hists[i] + "\n";
    }
    return s;
}
function update() {
    let func = document.getElementById("q").value;
    my.parser.radiansQ = this.radsQ;
    my.parser.newParse(func);
    let nStt = document.getElementById("nStt").value << 0;
    let nEnd = document.getElementById("nEnd").value << 0;
    optSet("nStt", nStt);
    optSet("nEnd", nEnd);
    optSet("func", func);
    let maxNRange = 10000;
    if (nEnd - nStt > maxNRange) {
        document.getElementById("calc").innerHTML =
            "n range > " + maxNRange.toString();
        document.getElementById("a").innerHTML = "";
        return;
    }
    let s = "";
    let sum = 0;
    for (let n = nStt; n <= nEnd; n++) {
        if (s.length > 0) s += " + ";
        my.parser.setVarVal("n", n);
        let x = my.parser.getVal();
        if (x == Number.POSITIVE_INFINITY) x = Number.NaN;
        if (x == Number.NEGATIVE_INFINITY) x = Number.NaN;
        s += x.toString();
        sum += x;
    }
    document.getElementById("calc").innerHTML = s;
    document.getElementById("a").innerHTML = sum.toString();
    let hist =
        "Sum(n=" +
        nStt.toString() +
        " to " +
        nEnd.toString() +
        ")  of  " +
        func +
        " = " +
        sum.toString();
    if (hist != my.lastHist) {
        if (my.lastHistTime + 2000 < Date.now()) {
            my.hists.push(hist);
            my.lastHist = hist;
        }
        my.lastHistTime = Date.now();
    }
}
function histpop() {
    console.log("editpop");
    let pop = document.getElementById("histpop");
    pop.style.transitionDuration = "0.3s";
    pop.style.opacity = 1;
    pop.style.zIndex = 12;
    pop.style.left = "100px";
    document.getElementById("histbox").value = getHist();
}
function editYes() {
    let pop = document.getElementById("histpop");
    pop.style.opacity = 0;
    pop.style.zIndex = 1;
    pop.style.left = "-500px";
}
function optGet(name) {
    let val = localStorage.getItem(`sigma.${name}`);
    if (val == null) val = my.opts[name];
    return val;
}
function optSet(name, val) {
    localStorage.setItem(`sigma.${name}`, val);
    my.opts[name] = val;
}
function Parser() {
    this.operators = "+-*(/),^.";
    this.rootNode;
    this.tempNode = [];
    this.Variable = "n";
    this.errMsg = "";
    this.radiansQ = true;
    this.vals = [];
    for (let i = 0; i < 26; i++) {
        this.vals[i] = 0;
    }
    this.reset();
}
Parser.prototype.setVarVal = function (varName, newVal) {
    switch (varName) {
        case "x":
            this.vals[23] = newVal;
            break;
        case "y":
            this.vals[24] = newVal;
            break;
        case "z":
            this.vals[25] = newVal;
            break;
        default:
            if (varName.length == 1) {
                this.vals[varName.charCodeAt(0) - "a".charCodeAt(0)] = newVal;
            }
    }
};
Parser.prototype.getVal = function () {
    return this.rootNode.walk(this.vals);
};
Parser.prototype.newParse = function (s) {
    this.reset();
    s = s.replace(/(\r\n|\n|\r)/gm, "");
    s = s.split(" ").join("");
    s = s.split("[").join("(");
    s = s.split("]").join(")");
    s = s.replace(/\u2212/g, "-");
    s = s.replace(/\u00F7/g, "/");
    s = s.replace(/\u00D7/g, "*");
    s = s.replace(/\u00B2/g, "^2");
    s = s.replace(/\u00B3/g, "^3");
    s = s.replace(/\u221a([0-9\.]+)/g, "sqrt($1)");
    s = s.replace(/\u221a\(/g, "sqrt(");
    s = this.fixParentheses(s);
    s = this.fixUnaryMinus(s);
    s = this.fixFactorial(s);
    s = this.fixImplicitMultply(s);
    this.rootNode = this.parse(s);
};
Parser.prototype.fixFactorial = function (s) {
    let currPos = 1;
    let chgQ = false;
    do {
        chgQ = false;
        let fPos = s.indexOf("!", currPos);
        if (fPos > 0) {
            let numEnd = fPos - 1;
            let numStt = numEnd;
            let cnum = s.charAt(numStt);
            if (cnum == "n") {
            } else {
                let cnum;
                do {
                    cnum = s.charAt(numStt);
                    numStt--;
                } while (cnum >= "0" && cnum <= "9");
                numStt += 2;
            }
            if (numStt <= numEnd) {
                let numStr = s.substr(numStt, numEnd - numStt + 1);
                numStr = "fact(" + numStr + ")";
                s = s.substr(0, numStt) + numStr + s.substr(numEnd + 2);
                currPos = fPos + numStr.length;
                chgQ = true;
            }
        }
    } while (chgQ);
    return s;
};
Parser.prototype.fixParentheses = function (s) {
    let sttParCount = 0;
    let endParCount = 0;
    for (let i = 0; i < s.length; i++) {
        if (s.charAt(i) == "(") sttParCount++;
        if (s.charAt(i) == ")") endParCount++;
    }
    while (sttParCount < endParCount) {
        s = "(" + s;
        sttParCount++;
    }
    while (endParCount < sttParCount) {
        s += ")";
        endParCount++;
    }
    return s;
};
Parser.prototype.fixUnaryMinus = function (s) {
    let x = s + "\n";
    let y = "";
    let OpenQ = false;
    let prevType = "(";
    let thisType = "";
    for (let i = 0; i < s.length; i++) {
        let c = s.charAt(i);
        if (c >= "0" && c <= "9") {
            thisType = "N";
        } else {
            if (this.operators.indexOf(c) >= 0) {
                if (c == "-") {
                    thisType = "-";
                } else {
                    thisType = "O";
                }
            } else {
                if (c == "." || c == this.Variable) {
                    thisType = "N";
                } else {
                    thisType = "C";
                }
            }
            if (c == "(") {
                thisType = "(";
            }
            if (c == ")") {
                thisType = ")";
            }
        }
        x += thisType;
        if (prevType == "(" && thisType == "-") {
            y += "0";
        }
        if (OpenQ) {
            switch (thisType) {
                case "N":
                    break;
                default:
                    y += ")";
                    OpenQ = false;
            }
        }
        if (prevType == "O" && thisType == "-") {
            y += "(0";
            OpenQ = true;
        }
        y += c;
        prevType = thisType;
    }
    if (OpenQ) {
        y += ")";
        OpenQ = false;
    }
    return y;
};
Parser.prototype.fixImplicitMultply = function (s) {
    let y = "";
    let prevType = "?";
    let prevName = "";
    let thisType = "?";
    let thisName = "";
    for (let i = 0; i < s.length; i++) {
        let c = s.charAt(i);
        if (c >= "0" && c <= "9") {
            thisType = "N";
        } else {
            if (this.operators.indexOf(c) >= 0) {
                thisType = "O";
                thisName = "";
            } else {
                thisType = "C";
                thisName += c;
            }
            if (c == "(") {
                thisType = "(";
            }
            if (c == ")") {
                thisType = ")";
            }
        }
        if (prevType == "N" && thisType == "C") {
            y += "*";
            thisName = "";
        }
        if (prevType == "N" && thisType == "(") {
            y += "*";
        }
        if (prevType == ")" && thisType == "(") {
            y += "*";
        }
        if (thisType == "(") {
            switch (prevName) {
                case "i":
                case "pi":
                case "e":
                case "a":
                case this.Variable:
                    y += "*";
                    break;
            }
        }
        y += c;
        prevType = thisType;
        prevName = thisName;
    }
    let regex = new RegExp("\\)" + this.Variable);
    y = y.replace(regex, ")*" + this.Variable);
    console.log("fixImplicitMultply:", s, y);
    return y;
};
Parser.prototype.reset = function () {
    this.tempNode = [];
    this.errMsg = "";
};
Parser.prototype.parse = function (s) {
    if (s == "") {
        return new MathNode("real", "0", this.radiansQ);
    }
    if (isNumeric(s)) {
        return new MathNode("real", s, this.radiansQ);
    }
    if (s.charAt(0) == "$") {
        if (isNumeric(s.substr(1))) {
            return this.tempNode[Number(s.substr(1))];
        }
    }
    let sLo = s.toLowerCase();
    if (sLo.length == 1) {
        if (sLo >= "a" && sLo <= "z") {
            return new MathNode("var", sLo, this.radiansQ);
        }
    }
    switch (sLo) {
        case "pi":
            return new MathNode("var", sLo, this.radiansQ);
    }
    let bracStt = s.lastIndexOf("(");
    if (bracStt > -1) {
        let bracEnd = s.indexOf(")", bracStt);
        if (bracEnd < 0) {
            this.errMsg += "Missing ')'\n";
            return new MathNode("real", "0", this.radiansQ);
        }
        let isParam = false;
        if (bracStt == 0) {
            isParam = false;
        } else {
            let prefix = s.substr(bracStt - 1, 1);
            isParam = this.operators.indexOf(prefix) <= -1;
        }
        if (!isParam) {
            this.tempNode.push(
                this.parse(s.substr(bracStt + 1, bracEnd - bracStt - 1))
            );
            return this.parse(
                s.substr(0, bracStt) +
                    "$" +
                    (this.tempNode.length - 1).toString() +
                    s.substr(bracEnd + 1, s.length - bracEnd - 1)
            );
        } else {
            let startM = -1;
            for (let u = bracStt - 1; u > -1; u--) {
                let found = this.operators.indexOf(s.substr(u, 1));
                if (found > -1) {
                    startM = u;
                    break;
                }
            }
            let nnew = new MathNode(
                "func",
                s.substr(startM + 1, bracStt - 1 - startM),
                this.radiansQ
            );
            nnew.addchild(
                this.parse(s.substr(bracStt + 1, bracEnd - bracStt - 1))
            );
            this.tempNode.push(nnew);
            return this.parse(
                s.substr(0, startM + 1) +
                    "$" +
                    (this.tempNode.length - 1).toString() +
                    s.substr(bracEnd + 1, s.length - bracEnd - 1)
            );
        }
    }
    let k;
    let k1 = s.lastIndexOf("+");
    let k2 = s.lastIndexOf("-");
    if (k1 > -1 || k2 > -1) {
        if (k1 > k2) {
            k = k1;
            let nnew = new MathNode("op", "add", this.radiansQ);
            nnew.addchild(this.parse(s.substr(0, k)));
            nnew.addchild(this.parse(s.substr(k + 1, s.length - k - 1)));
            return nnew;
        } else {
            k = k2;
            let nnew = new MathNode("op", "sub", this.radiansQ);
            nnew.addchild(this.parse(s.substr(0, k)));
            nnew.addchild(this.parse(s.substr(k + 1, s.length - k - 1)));
            return nnew;
        }
    }
    k1 = s.lastIndexOf("*");
    k2 = s.lastIndexOf("/");
    if (k1 > -1 || k2 > -1) {
        if (k1 > k2) {
            k = k1;
            let nnew = new MathNode("op", "mult", this.radiansQ);
            nnew.addchild(this.parse(s.substr(0, k)));
            nnew.addchild(this.parse(s.substr(k + 1, s.length - k - 1)));
            return nnew;
        } else {
            k = k2;
            let nnew = new MathNode("op", "div", this.radiansQ);
            nnew.addchild(this.parse(s.substr(0, k)));
            nnew.addchild(this.parse(s.substr(k + 1, s.length - k - 1)));
            return nnew;
        }
    }
    k = s.indexOf("^");
    if (k > -1) {
        let nnew = new MathNode("op", "pow", this.radiansQ);
        nnew.addchild(this.parse(s.substr(0, k)));
        nnew.addchild(this.parse(s.substr(k + 1, s.length - k - 1)));
        return nnew;
    }
    if (isNumeric(s)) {
        return new MathNode("real", s, this.radiansQ);
    } else {
        if (s.length == 0) {
            return new MathNode("real", "0", this.radiansQ);
        } else {
            this.errMsg += "'" + s + "' is not a number.\n";
            return new MathNode("real", "0", this.radiansQ);
        }
    }
};
function MathNode(typ, val, radQ) {
    this.tREAL = 0;
    this.tlet = 1;
    this.tOP = 2;
    this.tFUNC = 3;
    this.radiansQ = true;
    this.setNew(typ, val, radQ);
}
MathNode.prototype.setNew = function (typ, val, radQ) {
    this.radiansQ = typeof radQ !== "undefined" ? radQ : true;
    this.clear();
    switch (typ) {
        case "real":
            this.typ = this.tREAL;
            this.r = Number(val);
            break;
        case "var":
            this.typ = this.tVAR;
            this.v = val;
            break;
        case "op":
            this.typ = this.tOP;
            this.op = val;
            break;
        case "func":
            this.typ = this.tFUNC;
            this.op = val;
            break;
    }
    return this;
};
MathNode.prototype.clear = function () {
    this.r = 1;
    this.v = "";
    this.op = "";
    this.child = [];
    this.childCount = 0;
};
MathNode.prototype.addchild = function (n) {
    this.child.push(n);
    this.childCount++;
    return this.child[this.child.length - 1];
};
MathNode.prototype.getLevelsHigh = function () {
    let lvl = 0;
    for (let i = 0; i < this.childCount; i++) {
        lvl = Math.max(lvl, this.child[i].getLevelsHigh());
    }
    return lvl + 1;
};
MathNode.prototype.isLeaf = function () {
    return this.childCount == 0;
};
MathNode.prototype.getLastBranch = function () {
    if (this.isLeaf()) {
        return null;
    }
    for (let i = 0; i < this.childCount; i++) {
        if (!this.child[i].isLeaf()) {
            return this.child[i].getLastBranch();
        }
    }
    return this;
};
MathNode.prototype.fmt = function (htmlQ) {
    htmlQ = typeof htmlQ !== "undefined" ? htmlQ : true;
    let s = "";
    if (this.typ == this.tOP) {
        switch (this.op.toLowerCase()) {
            case "add":
                s = "+";
                break;
            case "sub":
                s = htmlQ ? "&minus;" : "-";
                break;
            case "mult":
                s = htmlQ ? "&times;" : "x";
                break;
            case "div":
                s = htmlQ ? "&divide;" : "/";
                break;
            case "pow":
                s = "^";
                break;
            default:
                s = this.op;
        }
    }
    if (this.typ == this.tREAL) {
        s = this.r.toString();
    }
    if (this.typ == this.tVAR) {
        if (this.r == 1) {
            s = this.v;
        } else {
            if (this.r != 0) {
                s = this.r + this.v;
            }
        }
    }
    if (this.typ == this.tFUNC) {
        s = this.op;
    }
    return s;
};
MathNode.prototype.walkFmt = function () {
    let s = this.walkFmta(true, "");
    s = s.replace("Infinity", "Undefined");
    return s;
};
MathNode.prototype.walkFmta = function (noparq, prevop) {
    let s = "";
    if (this.childCount > 0) {
        let parq = false;
        if (this.op == "add") parq = true;
        if (this.op == "sub") parq = true;
        if (prevop == "div") parq = true;
        if (noparq) parq = false;
        if (this.typ == this.tFUNC) parq = true;
        if (this.typ == this.tOP) {
        } else {
            s += this.fmt(true);
        }
        if (parq) s += "(";
        for (let i = 0; i < this.childCount; i++) {
            if (this.typ == this.tOP && i > 0) s += this.fmt();
            s += this.child[i].walkFmta(false, this.op);
            if (this.typ == this.tFUNC || (parq && i > 0)) {
                s += ")";
            }
        }
    } else {
        s += this.fmt();
        if (prevop == "sin" || prevop == "cos" || prevop == "tan") {
            if (this.radiansQ) {
                s += " rad";
            } else {
                s += "&deg;";
            }
        }
    }
    return s;
};
MathNode.prototype.walkNodesFmt = function (level) {
    let s = "";
    for (let i = 0; i < level; i++) {
        s += "|   ";
    }
    s += this.fmt();
    s += "\n";
    for (let i = 0; i < this.childCount; i++) {
        s += this.child[i].walkNodesFmt(level + 1);
    }
    return s;
};
MathNode.prototype.walk = function (vals) {
    if (this.typ == this.tREAL) return this.r;
    if (this.typ == this.tVAR) {
        switch (this.v) {
            case "x":
                return vals[23];
                break;
            case "y":
                return vals[24];
                break;
            case "z":
                return vals[25];
                break;
            case "pi":
                return Math.PI;
                break;
            case "e":
                return Math.exp(1);
                break;
            case "a":
                return vals[0];
                break;
            case "n":
                return vals[13];
                break;
            default:
                return 0;
        }
    }
    if (this.typ == this.tOP) {
        let val = 0;
        for (let i = 0; i < this.childCount; i++) {
            let val2 = 0;
            if (this.child[i] != null) val2 = this.child[i].walk(vals);
            if (i == 0) {
                val = val2;
            } else {
                switch (this.op) {
                    case "add":
                        val += val2;
                        break;
                    case "sub":
                        val -= val2;
                        break;
                    case "mult":
                        val *= val2;
                        break;
                    case "div":
                        val /= val2;
                        break;
                    case "pow":
                        if (val2 == 2) {
                            val = val * val;
                        } else {
                            val = Math.pow(val, val2);
                        }
                        break;
                    default:
                }
            }
        }
        return val;
    }
    if (this.typ == this.tFUNC) {
        let lhs = this.child[0].walk(vals);
        let angleFact = 1;
        if (!this.radiansQ) angleFact = 180 / Math.PI;
        let val = 0;
        switch (this.op) {
            case "sin":
                val = Math.sin(lhs / angleFact);
                break;
            case "cos":
                val = Math.cos(lhs / angleFact);
                break;
            case "tan":
                val = Math.tan(lhs / angleFact);
                break;
            case "asin":
                val = Math.asin(lhs) * angleFact;
                break;
            case "acos":
                val = Math.acos(lhs) * angleFact;
                break;
            case "atan":
                val = Math.atan(lhs) * angleFact;
                break;
            case "sinh":
                val = (Math.exp(lhs) - Math.exp(-lhs)) / 2;
                break;
            case "cosh":
                val = (Math.exp(lhs) + Math.exp(-lhs)) / 2;
                break;
            case "tanh":
                val =
                    (Math.exp(lhs) - Math.exp(-lhs)) /
                    (Math.exp(lhs) + Math.exp(-lhs));
                break;
            case "exp":
                val = Math.exp(lhs);
                break;
            case "log":
                val = Math.log(lhs) * Math.LOG10E;
                break;
            case "ln":
                val = Math.log(lhs);
                break;
            case "abs":
                val = Math.abs(lhs);
                break;
            case "deg":
                val = (lhs * 180) / Math.PI;
                break;
            case "rad":
                val = (lhs * Math.PI) / 180;
                break;
            case "sign":
                if (lhs < 0) {
                    val = -1;
                } else {
                    val = 1;
                }
                break;
            case "sqrt":
                val = Math.sqrt(lhs);
                break;
            case "round":
                val = Math.round(lhs);
                break;
            case "int":
                val = Math.floor(lhs);
                break;
            case "floor":
                val = Math.floor(lhs);
                break;
            case "ceil":
                val = Math.ceil(lhs);
                break;
            case "fact":
                val = factorial(lhs);
                break;
            default:
                val = NaN;
        }
        return val;
    }
    return 0;
};
function factorial(n) {
    if (n < 0) return NaN;
    if (n < 2) return 1;
    n = n << 0;
    let i;
    i = n;
    let f = n;
    while (i-- > 2) {
        f *= i;
    }
    return f;
}
function isNumeric(n) {
    return !isNaN(parseFloat(n)) && isFinite(n);
}
my.opts = { name: "user" };
function optGet(name) {
    let val = localStorage.getItem(`mif.${name}`);
    if (val == null) val = my.opts[name];
    return val;
}
function optSet(name, val) {
    localStorage.setItem(`mif.${name}`, val);
    my.opts[name] = val;
}
function getJSQueryVar(varName, defaultVal) {
    let scripts = document.getElementsByTagName("script");
    let lastScript = scripts[scripts.length - 1];
    let scriptName = lastScript.src;
    let bits = scriptName.split("?");
    if (bits.length < 2) return defaultVal;
    let query = bits[1];
    console.log("query: ", query);
    let vars = query.split("&");
    for (let i = 0; i < vars.length; i++) {
        let pair = vars[i].split("=");
        if (pair[0] == varName) {
            return pair[1];
        }
    }
    return defaultVal;
}
window.addEventListener("storage", themeChg);
themeChg();
function themeChg() {
    my.theme = localStorage.getItem("theme");
    console.log("themeChg to", my.theme);
    if (my.theme == "dark") {
        my.noClr = "black";
        my.yesClr = "#036";
    } else {
        my.noClr = "#f8f8f8";
        my.yesClr = "#dfd";
    }
}
function docInsert(s) {
    let div = document.createElement("div");
    div.innerHTML = s;
    let script = document.currentScript;
    script.parentElement.insertBefore(div, script);
}
function wrap(
    {
        id = "",
        cls = "",
        pos = "rel",
        style = "",
        txt = "",
        tag = "div",
        lbl = "",
        fn = "",
        opts = [],
    },
    ...mores
) {
    let s = "";
    s += "\n";
    txt += mores.join("");
    s +=
        {
            btn: () => {
                if (cls.length == 0) cls = "btn";
                return '<button onclick="' + fn + '"';
            },
            can: () => "<canvas",
            div: () => "<div",
            edit: () => '<textarea onkeyup="' + fn + '" onchange="' + fn + '"',
            inp: () => {
                if (cls.length == 0) cls = "input";
                let s = "";
                s += lbl.length > 0 ? '<label class="label">' + lbl + " " : "";
                s += '<input value="' + txt + '"';
                s +=
                    fn.length > 0
                        ? '  oninput="' + fn + '" onchange="' + fn + '"'
                        : "";
                return s;
            },
            out: () => {
                pos = "dib";
                if (cls.length == 0) cls = "output";
                let s = "";
                s += lbl.length > 0 ? '<label class="label">' + lbl + " " : "";
                s += "<span ";
                return s;
            },
            rad: () => {
                if (cls.length == 0) cls = "radio";
                return (
                    "<form" +
                    (fn.length > 0 ? (s += ' onclick="' + fn + '"') : "")
                );
            },
            sel: () => {
                if (cls.length == 0) cls = "select";
                let s = "";
                s += lbl.length > 0 ? '<label class="label">' + lbl + " " : "";
                s += "<select ";
                s += fn.length > 0 ? '  onchange="' + fn + '"' : "";
                return s;
            },
            sld: () =>
                '<input type="range" ' +
                txt +
                ' oninput="' +
                fn +
                '" onchange="' +
                fn +
                '"',
        }[tag]() || "";
    if (id.length > 0) s += ' id="' + id + '"';
    if (cls.length > 0) s += ' class="' + cls + '"';
    if (pos == "dib")
        s += ' style="position:relative; display:inline-block;' + style + '"';
    if (pos == "rel") s += ' style="position:relative; ' + style + '"';
    if (pos == "abs") s += ' style="position:absolute; ' + style + '"';
    s +=
        {
            btn: () => ">" + txt + "</button>",
            can: () => "></canvas>",
            div: () => " >" + txt + "</div>",
            edit: () => " >" + txt + "</textarea>",
            inp: () => ">" + (lbl.length > 0 ? "</label>" : ""),
            out: () =>
                " >" + txt + "</span>" + (lbl.length > 0 ? "</label>" : ""),
            rad: () => {
                let s = "";
                s += ">\n";
                for (let i = 0; i < opts.length; i++) {
                    let chk = "";
                    if (i == 0) chk = "checked";
                    s +=
                        '<input type="radio" id="r' +
                        i +
                        '" name="typ" style="cursor:pointer;" value="' +
                        opts[i][0] +
                        '" ' +
                        chk +
                        " />\n";
                    s +=
                        '<label for="r' +
                        i +
                        '" style="cursor:pointer;">' +
                        opts[i][1] +
                        "</label><br/>\n";
                }
                s += "</form>";
                return s;
            },
            sel: () => {
                let s = "";
                s += ">\n";
                for (let i = 0; i < opts.length; i++) {
                    let opt = opts[i];
                    let idStr = id + i;
                    let chkStr = opt.descr == txt ? " selected " : "";
                    s +=
                        '<option id="' +
                        idStr +
                        '" value="' +
                        opt.name +
                        '"' +
                        chkStr +
                        ">" +
                        opt.descr +
                        "</option>\n";
                }
                s += "</select>";
                if (lbl.length > 0) s += "</label>";
                return s;
            },
            sld: () => ">",
        }[tag]() || "";
    s += "\n";
    return s.trim();
}
init();
