User features
=============
* will have an account (optional if more than one user) **(S: 5, X: 5, M: h)**
* account activation (optional if more than one user and not running on localhost) **(S: 2, X: 4, M: l)**
* will be able to add books to the database (if it has the proper rights) **(S: 5, X: 5, M: h)**
* user will be able to add meta informations about a book (if it has the proper rights) **(S: 5, X: 5, M: h)**
* will add an image cover for a particular book (if it has the proper rights) **(S: 4, X: 4, M: m)**
* search for a certain book **(S: 5, X: 5, M: h)**
* sort books by multiple criteria **(S: 3, X: 5, M: m)**
* store an e-book for a certain book (if it has the proper rights) **(S: 2, X: 2, M: l)**
* delete a book (if it has the proper rights) **(S: 5, X: 5, M: h)**
* e-mail title/author and personal rating to friend/friends **(S: 4, X: 2, M: l)**
* rate book (1 to 5 stars) **(S: 1, X: 1, M: l)**

Books features
==============
* have a title **(S: 5, X: 5, M: h)**
* have an author **(S: 5, X: 5, M: h)**
* have description **(S: 5, X: 5, M: h)**
* have cover image **(S: 4, X: 2, M: l)**
* e-book variant attached **(S: 2, X: 1, M: l)**
* the date when the book was added **(S: 5, X: 5, M: h)**
* Download book if e-book variant attached **(S: 2, X: 4, M: l)**

Admin panel
===========
* add a new user **(S: 3, X: 5, M: m)**
* delete an user **(S: 3, X: 3, M: m)**
* ban an user **(S: 2, X: 3, M: l)**
* view informations for an certain user **(S: 3, X: 2, M: l)**
* send system message to all users (optional if more then one account) **(S: 5, X: 2, M: m)**
* set user rights for: **(S: 2, X: 1, M: m)**
    * add book
    * edit meta information
    * add image cover
    * store e-book
    * delete a book
* set site for maintenance (optional if not on localhost) **(S: 2, X: 1, M: l)**
* set user account activation (optional if not on localhost) **(S: 2, X: 1, M: l)**

Priority rating
===============
* S - starlays, X - xao, M - average

* Priority rating:
    * 1 - lowest
    * 2 - low
    * 3 - medium
    * 4 - high
    * 5 - highest

* Calculation of the average is done using arithmetic average
