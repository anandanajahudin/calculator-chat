# script.py
import sys
import json  # Add this line to import the json module
import matplotlib.pyplot as plt
import numpy as np

if __name__ == "__main__":
    # Access command-line arguments
    x_values = json.loads(sys.argv[1]) if len(sys.argv) > 1 else []
    y_values = json.loads(sys.argv[2]) if len(sys.argv) > 2 else []

    # Create a plot
    plt.plot(x_values, y_values)
    plt.title('Generated Plot')
    plt.xlabel('X-axis')
    plt.ylabel('Y-axis')

    # plt.legend(loc = 'upper left')
    plt.grid()
    plt.show()

    # Save the plot to a file
    # plt.savefig('generated_plot.png')
