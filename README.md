Runners World

On Runners World runners can create profiles, record their runs, and discuss common runners issues. The website has three sections: Profile, Stats, and Forum. The forum features a discussion board where fellow runners can answer questions related to running. The Stats section allows runners to set a weekly challenge and monitor their progress throughout the week. Finally, the profile page allows runners to view personal details of other users as well as describe themselves.

Getting Started

Visit st4rgut25 github account at https://github.com/st4rgut25/runners_world
You can download the runners_world repository as a zip onto your local machine for testing and developing. See deployment for notes on how to deploy the project on a live system.

Prerequisites

Install XAMPP from Apache Friends: https://www.apachefriends.org/download.html

Deployment

To deploy this onto your local machine download web server package XAMPP. Open the XAMPP applications folder and navigate to the htdocs directory. Move the runners_world repository to the htdocs directory. You can visit your website on your local computer at localhost followed by the name fo the repository (eg localhost/runners_world)

Once you have downloaded XAMPP, create a database called runners with the following tables: answer, profile, question and run. Create the fields listed below for each table.

    answer:    answer_id, question_id, date, answer_text, runner_id
    profile:   username, weekly_goal, about_me, location, email, password, id, date, avatar
    question:  question_id, runner_id, date, question_text, reply_count
    run:       Mon, Tue, Wed, Thu, Fri, Sat, Sun, run_id, weekly_total (all numbers)

Authors

Edward Cox

License

This project is licensed under the MIT License - see the LICENSE.md file for details


