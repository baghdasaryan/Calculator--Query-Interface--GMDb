PHP Web Calculator
==================

Contributors:
-------------
| Name                | Email                             |
| ----                | -----                             |
| Georgi Baghdasaryan | baghdasaryan@ucla.edu             |
| Michael Sweatt      | mickeysweatt@engineering.ucla.edu |

Project Description
-------------------
A simple online calculator implemented in PHP.

1. Calculator supports +, -, * and / operators and the evaluation of the input
follows the standard operator precedence (i.e., the operators are
left-associative and + and * operators have precedence over + and -).
2. Calculator works with both integer (e.g. 1234) and real (e.g. 123.45)
numbers.
3. Calculator does not support parentheses.
4. The calculator.php is more like a question-answering interface, and
therefore HTTP GET protocol was used to process the user input as suggested by
W3C.
5. Calculator utilizes regular expressions to detect divisions by zero.
6. White spaces are treated as empty characters.
7. Every two consecutive minus (**--**) signs are treated as a plus sign (**+**).

Usage
-----
1. Place *calculator.php* in your server's (e.g. Apache) root directory.
2. Now you can access the program by going to **_\<ip-address\>_/calculator.php**,
where _\<ip-address\>_ is your server's [IP address](http://en.wikipedia.org/wiki/IP_address "IP Address Wiki").

Notes
-----
* You need to have installed:
    * [Apache](http://httpd.apache.org/ "Apache") or any other server
    * [PHP](http://php.net/ "PHP")

