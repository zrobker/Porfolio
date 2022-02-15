import csv

def main():

    i_number = 0
    name = 1

    students = read_dict("students.csv", i_number)

    inumber = str(input("Please enter an I-number: "))
    
    if not inumber.isdigit():
        print("nice try sucka")
    else:
        if len(inumber) < 9:
            print("Invalid I-Number: too few digits")
        elif len(inumber) > 9:
            print("Invalid I-Number: too many digits")
        else:
            # The user input is a valid I-Number. Find
            # the I-Number in the list of I-Numbers.
            if inumber not in students:
                print("No such student")
            else:
                # Retrieve the student name that corresponds
                # to the I-Number that the user entered.
                value = students[inumber]
                name = value[name]

                # Print the student name.
                print(name)

def read_dict(filename,key_column_index):

    dictionary = {}

    with open(filename, "rt") as text_file:

        reader = csv.reader(text_file)    

        next(reader)

        for row in reader:

            key = row[key_column_index]
        

            dictionary[key] = row

    return dictionary
if __name__ == "__main__":
    main()