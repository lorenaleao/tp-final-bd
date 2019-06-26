#!/usr/bin/env python

import sqlite3
import sys

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

				#EXECUTE ESSAS LINHAS CASO SEU BD AINDA NÂO POSSUIA A COLUNA TITLE_POSTER
		#addColumn = "ALTER TABLE akas ADD COLUMN title_poster BLOB"
		#cursor.execute(addColumn)

		titles = ["Toy Story 4", "Us", "Avengers: Endgame", "O Auto da Compadecida", "The Matrix", "Captain Marvel", "Finding Nemo", "Le fabuleux destin d'Amélie Poulain"]
		
		image_addresses = []
		for s in titles:
			s = s.replace(" ", "_")
			s = s.replace(":", "")
			s += ".jpg"
			image_addresses.append(s)

		for i in range(len(titles)):
			data = readImage(image_addresses[i])
			binary_img = sqlite3.Binary(data)
			cursor.execute("""
				UPDATE akas SET title_poster=(?)
				WHERE title =(?)
				""", (binary_img, titles[i],))

		recoverImages(cursor, titles, image_addresses)
		
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
