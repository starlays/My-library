User features
=============
* will have an account (optional if more than one user) **(S: h, X: h, M: h)**
* account activation (optional if more than one user and not running on localhost) **(S: l, X: m, M: l)**
* will be able to add books to the database (if it has the proper rights) **(S: h, X: h, M: h)**
* user will be able to add meta informations about a book (if it has the proper rights) **(S: h, X: h, M: h)**
* will add an image cover for a particular book (if it has the proper rights) **(S: h, X: m, M: m)**
* search for a certain book **(S: h, X: h, M: h)**
* sort books by multiple criteria **(S: m, X: h, M: m)**
* store an e-book for a certain book (if it has the proper rights) **(S: l, X: l, M: l)**
* delete a book (if it has the proper rights) **(S: h, X: h, M: h)**
* e-mail title/author and personal rating to friend/friends **(S: l, X: l, M: l)**
* rate book (1 to 5 stars) **(S: l, X: l, M: l)**

Books features
==============
* have a title **(S: h, X: h, M: h)**
* have an author **(S: h, X: h, M: h)**
* have description **(S: h, X: h, M: h)**
* have cover image **(S: m, X: l, M: l)**
* e-book variant attached **(S: l, X: l, M: l)**
* the date when the book was added **(S: h, X: h, M: h)**
* Download book if e-book variant attached **(S: l, X: m, M: l)**

Admin panel
===========
* add a new user **(S: m, X: h, M: m)**
* delete an user **(S: m, X: m, M: m)**
* ban an user **(S: l, X: m, M: l)**
* view informations for an certain user **(S: m, X: l, M: l)**
* send system message to all users (optional if more then one account) **(S: h, X: l, M: m)**
* set user rights for: **(S: l, X: h, M: m)**
    * add book
    * edit meta information
    * add image cover
    * store e-book
    * delete a book
* set site for maintenance (optional if not on localhost) **(S: l, X: l, M: l)**
* set user account activation (optional if not on localhost) **(S: l, X: l, M: l)**

Priority rating
===============
* S - starlays, X - xao, M - average

* Priority rating:
    * l - low
    * m - medium
    * h - high
