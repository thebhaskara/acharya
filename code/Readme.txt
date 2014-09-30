Requirements: 
Apache, PHP, MySQL

Steps to install: 
1. copy all the code files into a server public folder (like htdocs for xampp).
2. run CreatePaperNew.sql on MySQL to add the required db stuff.


if you are not logged in, you would be shown login/register page where you can login or register.
there are two roles, one is examiner(administrator) and other is applicant(candidate).
following features are provided for examiners.
    Create topic and level definitions is provided in "add others" link.
    Create scenario and questions is provided in add scenario link.
    Create exam definition by specifying certain exam specific stuff.
    Create and associate papers with the expected candidates.

following are provided for candidates:
    start exam. 
        the latest linked exam to that candidate would be displyed and would be ready to answer.
