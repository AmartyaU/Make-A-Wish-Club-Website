/* TODO: create tables */

CREATE TABLE 'accounts' (
	'id' INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
	'username' TEXT UNIQUE NOT NULL,
	'password' TEXT NOT NULL
);

CREATE TABLE `current_events` (
	`id` INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
	`title` TEXT NOT NULL UNIQUE,
	`location` TEXT NOT NULL,
	`image_date` TEXT NOT NULL,
  `image_title` TEXT NOT NULL,
  `image_ext` TEXT NOT NULL,
  `article` TEXT NOT NULL
);

CREATE TABLE `past_events` (
	`id` INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
	`title` TEXT NOT NULL UNIQUE,
  `description` TEXT NOT NULL
);

/* TODO: initial seed data */

INSERT INTO accounts (username, password) VALUES ('admin1', '$2y$10$4VmvuRAdlqO5byG1H8Um5.CfvcTsCrTl1HtohGaMpkw/ywFlufGjq'); /* password1 */
INSERT INTO accounts (username, password) VALUES ('admin2', '$2y$10$vENrLRMcFH8u24wdJ.X7E.72ErzmTpEwrkqD68nVnxY4lXFJdfJC6'); /* password2 */

INSERT INTO current_events (title, location, image_date, image_title, image_ext, article) VALUES ('5K Run', 'Botanical Garden', 'May 9,2018','Wish1', 'jpg', "Make-A-Wish at Cornell University is holding their first annual 5k to benefit Make-A-Wish Central New York! Registration will start at 10:00 AM, followed by a presentation by a wish ambassador, performance groups, and then kick-off at 11:00 AM. Food and beverages will be provided and t-shirts are included with admission.
	If you’d like to make a donation or get involved with our organization, please visit the contact page for more information!");
INSERT INTO current_events (title, location, image_date, image_title, image_ext, article) VALUES ('Bake Sale', 'WSH', 'May 18,2018', 'Wish2', 'jpg', "Stressed out abut exams? Tired of studying?
	Take a break! We will be having a Bake Sale outside of Willard Straight Hall at 3pm- 5pm! Get excited for tons of baked goods and come
	out support a child in need. We really want to help make their wishes come true!");
INSERT INTO current_events (title, location, image_date, image_title, image_ext, article) VALUES ('Carnation Sale', 'Arts Quad', 'August 23,2018', 'Wish3', 'jpg', "Welcome back Everyone! Start your semester right
	and buy a Carnation to support Make a Wish at Cornell. We will be out on the Arts Quad all day with beautiful flowers. Hope to see you there!");


INSERT INTO past_events (title, description) VALUES (" Midterm week Bake Sale", "Thanks for supporting our bakesale today, every contribution counts! Good luck with your exams, and please stay tuned for our upcoming events. ");
INSERT INTO past_events (title, description) VALUES ("Valentine's Day Carnation Sale", "Thank you to everybody who bought a carnation at today's sale. Hope that it went to someone special, and Happy Valintines Day!");
