import pandas as pd
import numpy as np
import sys
from sklearn.feature_extraction.text import CountVectorizer
from sklearn.metrics.pairwise import cosine_similarity

def get_title_from_index(index):
	return df[df.index == index]["title"].values[0]

def get_index_from_title(title):
	return df[df.title == title]["index"].values[0]


#Open and read CSV File
df = pd.read_csv("movie_metadata_revised.csv")
#print df.columns
#select attributes of each movie that will be used for calculation 

attributes = ['keywords','cast','genres','director']
#create a column in DF which combines all selected attributes
for att in attributes:
	df[att] = df[att].fillna('')

def combine_attributes(row):
	try:
		return row['keywords'] +" "+row['cast']+" "+row["genres"]+" "+row["director"]
	except:
		print("Error:", row)

df["combined_attributes"] = df.apply(combine_attributes,axis=1)

#print "Combined attributes:", df["combined_features"].head()

#create count matrix from this new combined column
cv = CountVectorizer()

count_matrix = cv.fit_transform(df["combined_attributes"])

#compute cosine similarity based on the count_matrix
cosine_sim = cosine_similarity(count_matrix) 

movie_user_likes = sys.argv[1] #input("Enter Movie Name:") 
movie_user_likes = movie_user_likes.title() 

#print ("enter movie name", sys.arg["enter movie name"])


#get index of this movie from its title
movie_index = get_index_from_title(movie_user_likes)

similar_movies =  list(enumerate(cosine_sim[movie_index]))

#get a list of similar movies(most similar to least similar)
sorted_similar_movies = sorted(similar_movies,key=lambda x:x[1],reverse=True)
sorted_similar_movies.pop(0)
#recommend 5 most similar movies
i=0
for element in sorted_similar_movies:
		print(get_title_from_index(element[0]))
		i=i+1
		if i>5:
			break
