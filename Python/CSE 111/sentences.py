import random

def main():
    follow = ""
    print("I am a program that generates sentences.")
    print()
    while follow.lower() != "no":
        print()
        quantity = get_quantity()
        tense = get_tense()
        random_sentence = get_random_sentence(quantity, tense)
        random_or_not = input ("Would you like a random sentence? (yes or no): ")
        print()
        if random_or_not.lower() == "yes":
            print (random_sentence)
            print()
        elif random_or_not.lower() != "yes":
            length_of_sentence = input ("Please write what length of sentence (enter short or long): ")
            quantity_of_sentence = int(input("Please write if the sentence should be singular or plural (enter 1 or 2): "))
            tense_of_sentence = input("Please enter tense of sentence (enter past, present, or future): ")
            if length_of_sentence.lower() == "short" and quantity_of_sentence == 1 and tense_of_sentence.lower() == "past":
                print (get_determiner(1).capitalize(), get_noun(1), get_verb(1,"past"))
                print()
            elif length_of_sentence.lower() == "short" and quantity_of_sentence == 2 and tense_of_sentence.lower() == "past":
                print (get_determiner(2).capitalize(), get_noun(2), get_verb(2,"past"))
                print()
            elif length_of_sentence.lower() == "short" and quantity_of_sentence == 1 and tense_of_sentence.lower() == "present":
                print (get_determiner(1).capitalize(), get_noun(1), get_verb(1,"present"))
                print()
            elif length_of_sentence.lower() == "short" and quantity_of_sentence == 2 and tense_of_sentence.lower() == "present":
                print (get_determiner(2).capitalize(), get_noun(2), get_verb(2,"present"))
                print()
            elif length_of_sentence.lower() == "short" and quantity_of_sentence == 1 and tense_of_sentence.lower() == "future":
                print (get_determiner(1).capitalize(), get_noun(1), get_verb(1,"future"))
                print()
            elif length_of_sentence.lower() == "short" and quantity_of_sentence == 2 and tense_of_sentence.lower() == "future":
                print (get_determiner(2).capitalize(), get_noun(2), get_verb(2,"future"))
                print()
            elif length_of_sentence.lower() == "long" and quantity_of_sentence == 1 and tense_of_sentence.lower() == "past":
                print (get_determiner(1).capitalize(), get_noun(1), get_verb(1, "past"), get_prepositional_phrase(1)) 
                print()
            elif length_of_sentence.lower() == "long" and quantity_of_sentence == 2 and tense_of_sentence.lower() == "past":
                print (get_determiner(2).capitalize(), get_noun(2), get_verb(2, "past"), get_prepositional_phrase(2)) 
                print()
            elif length_of_sentence.lower() == "long" and quantity_of_sentence == 1 and tense_of_sentence.lower() == "present":
                print (get_determiner(1).capitalize(), get_noun(1), get_verb(1, "present"), get_prepositional_phrase(1)) 
                print()
            elif length_of_sentence.lower() == "long" and quantity_of_sentence == 2 and tense_of_sentence.lower() == "present":
                print (get_determiner(2).capitalize(), get_noun(2), get_verb(2, "present"), get_prepositional_phrase(2)) 
                print()
            elif length_of_sentence.lower() == "long" and quantity_of_sentence == 1 and tense_of_sentence.lower() == "future":
                print (get_determiner(1).capitalize(), get_noun(1), get_verb(1, "future"), get_prepositional_phrase(1)) 
                print()
            elif length_of_sentence.lower() == "long" and quantity_of_sentence == 2 and tense_of_sentence.lower() == "future":
                print (get_determiner(2).capitalize(), get_noun(2), get_verb(2, "future"), get_prepositional_phrase(2)) 
                print() 
                
            else:
                print("error here")       
        follow = input("Would you like to generate another sentence? (yes or no): ")
    else:
        print()
        print("Thanks, come back later to make more sentences!")

def get_random_sentence(quantity, tense):
    random_sentences = [1,2]
    random_sentence = random.choice(random_sentences)

    if random_sentence == 1:
        random_sentence = (f"{get_determiner(quantity).capitalize()} {get_noun(quantity)} {get_verb(quantity, tense)}.")
    elif random_sentence != 1:
        random_sentence = (f"{get_determiner(quantity).capitalize()} {get_noun(quantity)} {get_verb(quantity, tense)} {get_prepositional_phrase(quantity)}")
    return random_sentence

def get_quantity():
    quantities = [1,2]
    quantity = random.choice(quantities)
    return quantity

def get_tense():
    tenses = ["past","present","future"]
    tense = random.choice(tenses)
    return tense

def get_determiner(quantity):
    
    if quantity == 1:
        determiners = ["the", "one","a"]
    else:
        determiners = ["some","two", "many"]
    determiner = random.choice(determiners)
    return determiner

def get_noun(quantity):

    if quantity ==1:
        nouns = ["adult","bird","boy","car","cat","child","dog",
        "girl", "man", "woman"]
    else:
        nouns = ["adults", "birds", "boys", "cars", "cats","children",
        "dogs", "girls", "men", "women"]
    noun = random.choice(nouns)
    return noun

def get_verb(quantity, tense):
    
    if tense == "past":
        verbs = ["drank", "ate", "grew", "laughed", "thought",
        "ran", "slept", "talked", "walked", "wrote"]
    elif tense == "future":
        verbs = [ "will drink", "will eat", "will grow", "will laugh",
        "will think", "will run", "will sleep", "will talk",
        "will walk", "will write"]
    elif tense == "present" and quantity == 1:
        verbs = ["drinks", "eats", "grows", "laughs", "thinks",
        "runs", "sleeps", "talks", "walks", "writes"]
    elif tense == "present" and quantity != 1:
        verbs = ["drink", "eat", "grow", "laugh", "think",
        "run", "sleep", "talk", "walk", "write"]
    verb = random.choice(verbs)
    return verb

def get_preposition():

    prepositions = ["about", "above", "across", "after", "along",
        "around", "at", "before", "behind", "below",
        "beyond", "by", "despite", "except", "for",
        "from", "in", "into", "near", "of",
        "off", "on", "onto", "out", "over",
        "past", "to", "under", "with", "without"]
    preposition = random.choice(prepositions)
    return preposition

def get_prepositional_phrase(quantity):

    if quantity == 1:
        prepositional_phrase = (f"{get_preposition()} {get_determiner(1)} {get_noun(1)}.")
    elif quantity != 1:
        prepositional_phrase = (f"{get_preposition()} {get_determiner(2)} {get_noun(2)}.")
    return prepositional_phrase

main()