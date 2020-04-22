import os
import glob

for filepath in glob.glob('**/*.php', recursive=True):
    print(filepath)
    if os.path.isfile(filepath) and filepath != "source.txt":
        a = open('source.txt', 'a+')
        a.write("\n")
        a.write("#################################\n")
        a.write(filepath + "\n")
        a.write("#################################\n")
        a.write("\n")

        with open(filepath, "r") as file:
            for line in file:
                stripped_line = line.strip()
                a.write(stripped_line + "\n")
