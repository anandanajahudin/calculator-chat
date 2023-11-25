# script.py
import sys
import numpy as np
import json  # Add this line to import the json module
import matplotlib.pyplot as plt
from sympy import symbols, lambdify, parse_expr

if __name__ == "__main__":
    # Access command-line arguments
    # equation_str = sys.argv[1] if len(sys.argv) > 1 else 'x'

    # Parse the equation
    # x = symbols('x')
    # equation = lambdify(x, parse_expr(equation_str), 'numpy')

    x_values = json.loads(sys.argv[1]) if len(sys.argv) > 1 else []
    y_values = json.loads(sys.argv[2]) if len(sys.argv) > 2 else []

    # Create a plot
    plt.plot(x_values, y_values)

    # Generate data for the plot
    # x_vals = np.linspace(2, -10, 100)
    # y_vals = equation(x_vals)

    # Create a plot
    # plt.plot(x_vals, y_vals)
    plt.title("Plot of the Equation")
    plt.xlabel('X-axis')
    plt.ylabel('Y-axis')

    # plt.legend(loc = 'upper left')
    plt.grid()
    plt.show()

    # Save the plot to a file
    # plt.savefig('generated_plot.png')
