# G05 - Applied Web Project (Environmental Conservation Recruitment Website)

COS10026 Web Technology Project
Swinburne University, Semester 2 2026

## Live Site
https://106009537.github.io/g05-applied-web-project/


## Jira Board
https://g05-applied-web-project.atlassian.net?continue=https%3A%2F%2Fg05-applied-web-project.atlassian.net%2Fwelcome%2Fsoftware&atlOrigin=eyJpIjoiOThjYzRhYTkyYzBmNDkzMjgwZmRiYzQ2M2FmZmY1MzgiLCJwIjoiaiJ9


## Group Contributions: G05

| Name | Contributions |
|------|---------------|
| Eduardo Lemos | **Part 1:** Homepage and About Us HTML/CSS; header and footer HTML/CSS; Jira, GitHub repository, README and GitHub Pages setup; homepage image generation and styling; drafted Group Agreement. **Part 2:** Task 3 – Created EOI database table and status ENUM. Task 6 – Developed administrator authentication, account setup script, and HR management page (`manage.php`) with EOI searching, sorting, deletion, and status updates; implemented security measures including password hashing, session protection, prepared statements, XSS escaping, and CSRF tokens; tested and refined functionality and styling. |
| Alisha Khokhar | Part 1: built the Job Application page (apply.html) with the full form, required fields, validation patterns and fieldsets, plus the Flexbox layout styling; resolved a Git merge conflict in the shared styles.css. Part 2: converted the pages to PHP and built the shared header, navigation and footer includes (Task 1); built process_eoi.php with server-side validation, sanitising, a job reference check and database saving (Task 4); added small-screen and keyboard-focus styling for the application form. | 
| Sebastian Kesuma | Left the project on day one
| Cameron Yardy | CSS Styling, Jobs.html, Page Specific style Requirements, Created Settings.php, Created a dynamic jobs that retireves from the databse, configured the about.php file to make the about page tables dynamic and retrieve data from the database. Fixed mistakes from Part 1.
 |



## Project Structure
- `index.php` - Home page
- `jobs.php` - Job listings
- `apply.php` - Application form
- `about.php` - About the team
- `styles.css` - Main stylesheet
- `g0bdb.sql` - Main SQL database 
- `header.inc` - Global header
- `footer.inc` - Global footer
- `manage.php` - Management page
- `process_eoi.php` - Validates and saves job applications
- `setup_admin_acc.php` - One time admin setup


## GenAI Acknowledgement [We'll add any tools/prompts used, per unit requirements]
1. Used Claude to format above Group Contributions Table
2. Used ChatGPT to generate Job positions/details
3. Used AI to apply the premade CSS Style to all pages
4. Used ChatGPT to assist with css box layout and image sizing to ensure responsive design at various window sizes on index and About Us.
5. Used ChatGPT to generate all images and logos in index, about us and header.
6. Used ChatGPT to generate text explanations about the company on index.
7. Used ChatGPT to help fix issues flagged by Accessibility Checker
8. Used ChatGPT to "make all of About.php's articles Dynamic from g05db.sql"
9. Used ChatGPT to check work agiasnt Rubric, prompt was given all code and all of the rubric
10. Alisha: used Claude (Anthropic) to help build the shared header, navigation and footer includes and process_eoi.php, and to help with the apply form's small-screen and keyboard-focus styling. Example prompt: "Help me with Task 4, process_eoi.php, for my Part 2 project". Prompts are also credited in the code comments.

### Eddy's AI Usage Acknowledgement for part 2(Tasks 3 and 6)

ChatGPT was used for technical discussions, development assistance, debugging, security, and code explanations.

1. Discussed EOI database structure, SQL data types, and ENUM values.
2. Troubleshot database import errors and table configuration.
3. Explored PHP session-based authentication and password verification.
4. Used ChatGPT to generate and refine `setup_admin_acc.php`, a PHP script for creating an administrator account with a securely hashed password.
5. Discussed and implemented protections against SQL injection, XSS, and CSRF.
6. Developed EOI searching, sorting, deletion, and status update functionality.
7. Discussed combining HR management functions into a single PHP page.
8. Reviewed CSS layout, form alignment, and responsive styling.
9. Troubleshot PHP, MySQL, and session-related issues.
10. Requested explanations and code comments to understand PHP functions and database queries.
11. Reviewed implementation against assignment requirements.

**Example prompts (paraphrased):**

- "How can I implement a secure administrator login system using PHP sessions and MySQL?"
- "Generate a simple PHP script to create an administrator account with a hashed password. I want it as simple an implementation as possible so I can break it down and understand it"
- "What are SQL injection, XSS, and CSRF, and how can I protect my PHP forms against them?"
- "How can I implement searching by job reference, applicant name, and sorting in manage.php?"
- "Can we simplify this code while keeping the required functionality and security?"
- "Explain each variable and function in this PHP code, including where the data comes from and where it goes."
- "Review my implementation against the assignment rubric and identify anything missing."
