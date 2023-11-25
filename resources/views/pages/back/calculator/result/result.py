# script.py
import sys
import matplotlib.pyplot as plt
import numpy as np

if __name__ == "__main__":
    # Access command-line arguments
    arg1 = float(sys.argv[1]) if len(sys.argv) > 1 else 1.0
    arg2 = float(sys.argv[2]) if len(sys.argv) > 2 else 1.0

    # Generate data for the plot
    x = np.linspace(0, 10, 100)
    y = arg1 * np.sin(arg2 * x)

    # Create a plot
    plt.plot(x, y)
    plt.title('Generated Plot')
    plt.xlabel('X-axis')
    plt.ylabel('Y-axis')

    # Save the plot to a file
    plt.savefig('generated_plot.png')
