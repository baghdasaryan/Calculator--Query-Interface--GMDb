Web Query Interface
===================

Contributors:
-------------
| Name                | Email                             |
| ----                | -----                             |
| Georgi Baghdasaryan | baghdasaryan@ucla.edu             |
| Michael Sweatt      | mickeysweatt@engineering.ucla.edu |

Description of Table Schemas
----------------------------
The Movie table: This table describes information regarding movies in the
database. It specifies an identification number unique to each movie, the title
of the movie, the year the movie was released, the MPAA rating given to the
movie, and the production company that produced the movie. The schema of the
Movie table is given as follows:

*Movie(id, title, year, rating, company)*

| Name    | Type         | Description        |
| ----    | ----         | -----------        |
| id      | INT          | Movie ID           |
| title   | VARCHAR(100) | Movie title        |
| year    | INT          | Release year       |
| rating  | VARCHAR(10)  | MPAA rating        |
| company | VARCHAR(50)  | Production company |

The Actor table: This table describes information regarding actors and actresses
of movies. It specifies an identification number unique to all people (which is
shared between actors and directors), the last name of the person, the first
name of the person, the sex of the person, the date of birth of the person, and
the date of death of the person if applicable. The schema of the Actor table is
given as follows:

*Actor(id, last, first, sex, dob, dod)*

| Name  | Type        | Description      |
| ----  | ----        | -----------      |
| id    | INT         | Actor ID         |
| last  | VARCHAR(20) | Last name        |
| first | VARCHAR(20) | First name       |
| sex   | VARCHAR(6)  | Sex of the actor |
| dob   | DATE        | Date of birth    |
| dod   | DATE        | Date of death    |

The Director table: It describes information regarding directors of movies. It
specifies an identification number of the director, the last name of the
director, the first name of the director, the date of birth of the director, and
the date of death to the director if applicable. The schema of the Director
table is given as follows:

*Director(id, last, first, dob, dod)*

| Name  | Type        | Description   |
| ----  | ----        | -----------   |
| id    | INT         | Director ID   |
| last  | VARCHAR(20) | Last name     |
| first | VARCHAR(20) | First name    |
| dob   | DATE        | Date of birth |
| dod   | DATE        | Date of death |

Note that the ID is unique to all people (which is shared between actors and
directors). That is, if a person is both an actor and a director, the person
will have the same ID both in the Actor and the Director table.

The MovieGenre table: It describes information regarding the genre of movies. It
specifies the identification number of a movie, and the genre of that movie. The
schema of the MovieGenre table is given as follows:

*MovieGenre(mid, genre)*

| Name  | Type        | Description |
| ----  | ----        | ----------- |
| mid   | INT         | Movie ID    |
| genre | VARCHAR(20) | Movie genre |

The MovieDirector table: It describes the information regarding the movie and
the director of that movie. It specifies the identification number of a movie,
and the identification number of the director of that movie. The schema of the
MovieDirector table is given as follows:

*MovieDirector(mid, did)*

| Name | Type | Description |
| ---- | ---- | ----------- |
| mid  | INT  | Movie ID    |
| did  | INT  | Director ID |

The MovieActor table: It describes information regarding the movie and the
actor/actress of that movie. It specifies the identification number of a movie,
and the identification number of the actor/actress of that movie. The schema of
the MovieActor table is given as follows:

*MovieActor(mid, aid, role)*

| Name | Type        | Description         |
| ---- | ----        | -----------         |
| mid  | INT         | Movie ID            |
| aid  | INT         | Actor ID            |
| role | VARCHAR(50) | Actor role in movie |

The Review table: Later in Project 1C, you will create a Web interface where the
users of your system can add ?reviews  on a movie (similarly to Amazon product
reviews). The Review table stores the reviews added in by the users in the
following schema:

*Review(name, time, mid, rating, comment)*

| Name    | Type         | Description      |
| ----    | ----         | -----------      |
| name    | VARCHAR(20)  | Reviewer name    |
| time    | TIMESTAMP    | Review time      |
| mid     | INT          | Movie ID         |
| rating  | INT          | Review rating    |
| comment | VARCHAR(500) | Reviewer comment |

Each tuple specifies the name of the reviewer, the timestamp of the review, the
movie id, the rating that the reviewer gave the movie (i.e., x out of 5), and
additional comments the reviewer gave about the movie.

In order to assign a new ID to, say, an actor/director, the system has to
remember what was the largest ID that it assigned to a person in the last
insertion. The MaxPersonID table is used for this purpose, which has the
following schema:

*MaxPersonID(id)*

| Name | Type | Description                    |
| ---- | ---- | -----------                    |
| id   | INT  | Max ID assigned to all persons |

MaxPersonID is a one-tuple, one-attribute table which maintains the largest ID
number that the system has assigned to a person so far. Whenever a new
actor/director is inserted, the system looks up this table, increases the ID
value of the tuple by one, and assigns the increased ID value to the new
actor/director. You may treat this MaxPersonID table as a "persistent variable"
that remembers its value even after your program stops.

The MaxMovieID is used similarly to assign a new ID to a new movie inserted by
the user. As a new movie is added to the database, the entry in this table is
incremented and assigned to the new movie. The schema of the MaxMovieID table is
given as follow:

MaxMovieID(id)

| Name | Type | Description                   |
| ---- | ---- | -----------                   |
| id   | INT  | Max ID assigned to all movies |

Web Query Interface
-------------------
After loading data in the tables specified above, you can use *query.php* page that
allows users to type in a SQL SELECT statement in a text input box and submit
the query through a Web browser. Given a user query, your php code executes the
query on MySQL and returns the results as the results page in an HTML table.
To make this part of project manageable, for this part (and this part only) you
may assume that users will always issue correct SELECT queries and all user
inputs can be trusted.

Usage
-----
1. Create schemas mentioned above or any other schemas in a MySQL database named
   *OnlineDB*.
2. Go to **line 43** in *query.php* and change **<LOGIN>** to your database
   login and <PASSWORD> to the password of your database.
3. In case if your database is not on running on the same machine where your
   *query.php* is located - change **"localhost"** to **"<ip-address>"** where
   _<ip-address>_ is the [IP address](http://en.wikipedia.org/wiki/IP_address "IP Address Wiki")
   of the machine at which your database resides. This change should be made on
   **line 43** in *query.php*.
4. Place *query.php* in your server's (e.g. Apache) root directory.
5. Now you can access the program by going to **_<ip-address>_/query.php**,
   where _<ip-address>_ is your server's [IP address](http://en.wikipedia.org/wiki/IP_address "IP Address Wiki").

Notes
-----
* Why implementing *query.php* we assumed that the users will always issue
correct SELECT queries and all user inputs can be trusted.
* You need to have installed:
    * [Apache](http://httpd.apache.org/ "Apache") or any other server
    * [PHP](http://php.net/ "PHP")
    * [MySQL](http://www.mysql.com/ "MySQL")
