import pandas as pd
import numpy as np
from sklearn.feature_extraction.text import CountVectorizer
from sklearn.metrics.pairwise import cosine_similarity


def get_title_from_index(index):
	return df[df.index == index]["title"].values[0]

def get_index_from_title(title):
	return df[df.title == title]["index"].values[0]

#Open and read movie database

df = pd.read_csv("movie_dataset.csv")

#Choose attributes of each movie that will be used to make a recommendation
#We will use keywords, cast, genres, and director

attributes = ['keywords', 'cast', 'genres', 'director'] 

#Combine all attributes into one column in the dataframe

for attribute in attributes:
	df[attribute] = df[attribute].fillna('')
	
def combine(row):
	try:
		return row['keywords'] +" "+row['cast']+" "+row["genres"]+" "+row["director"]
		
	except:
		print ("Error:", row)

df["combined"] = df.apply(combine, axis=1)

#new count matrix
cv = CountVectorizer()

count_matrix = cv.fit_transform(df["combined"])
#Calculate cosine similarity with count_matrix
cos_sim = cosine_similarity(count_matrix) 

movie_user_likes = "Fight Club"

#Get index of this movie from its title

movie_index = get_index_from_title(movie_user_likes)

similar =  list(enumerate(cos_sim[movie_index]))

#get list of similar movies, order by most similar to least similar 

sortedSimilar = sorted(similar,key=lambda x:x[1],reverse=True)

## Step 8: Print titles of first 20 movies

i=0
for element in sortedSimilar:
		print (get_title_from_index(element[0]))
		i+=1
		if i>20:
			break
