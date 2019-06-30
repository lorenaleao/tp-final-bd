#!/usr/bin/env python

### ------------------------- import_images.py -------------------------------- ###
#
# This script:
# 	- adds a column called "title_poster" in the "akas" table of 
# 	  the "imdb.db" file if it doesn't exist yet;
#	- inserts the images listed in the "titles.txt" file, which are
#	  stored in the Posters folder, in that column;
#	- has a function to retrieve the images from the database (retrieveImages);
#	- must be in the same directory as the "imdb.db" file and the Posters folder.
#
### --------------------------------------------------------------------------- ###

import sqlite3
import sys

def insertImage(cursor, title, title_poster):
	cursor.execute("""
		UPDATE akas SET title_poster=(?)
		WHERE title =(?)
		""", (title_poster, title))

def readImage(filename):
	fin = None

	try:
		fin = open(filename, "rb")
		img = fin.read()
		return img

	except IOError as e:
		print(e)
		sys.exit(1)

	finally:
		if fin:
			fin.close()

def writeImage(data, filename):
	fout = None

	try:
		fout = open(filename,'wb')
		fout.write(data)

	except IOError as e:
		print(e)
		sys.exit(1)

	finally:
		if fout:
			fout.close()

def recoverImages(cursor, titles, image_addresses):
	for i in range(len(titles)):
		cursor.execute("""
				SELECT title_poster 
				FROM akas 
				WHERE title =(?)
				LIMIT 1 
				""", (titles[i],))
		
		data = cursor.fetchone()[0]
		filename = "_" + image_addresses[i]
		writeImage(data, filename)

def main():
	
	try:
		conn = sqlite3.connect('imdb.db')
		cursor = conn.cursor()

		## EXECUTE ESSAS LINHAS CASO SEU BD AINDA NÃO POSSUA A COLUNA TITLE_POSTER
		## execute the next lines if the "akas" table in your database does not have the "title_poster" column yet
		
		#addColumn = "ALTER TABLE akas ADD COLUMN title_poster BLOB"
		#cursor.execute(addColumn)

		with open("titles.txt") as input_file:
			titles = input_file.readlines()

		posters_folder_path = "Posters/"
		image_addresses = []
		for s in titles:
			s = s.replace("\n", "")
			s = s.replace(" ", "_")
			s = s.replace(":", "")
			s = posters_folder_path + s + ".jpg"
			image_addresses.append(s)

		for i in range(len(titles)):
			data = readImage(image_addresses[i])
			binary_img = sqlite3.Binary(data)
			insertImage(cursor, titles[i], binary_img)

		## execute the next line when you want to retrieve the images from the database
		#recoverImages(cursor, titles, image_addresses)
		
	except sqlite3.Error as e:
		if conn:
			conn.rollback()
		print(e)
		sys.exit(1)

	finally:
		if conn:
			conn.close()

if __name__ == "__main__":
	main()
