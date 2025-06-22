# 📝 ToDo App — PHP & MySQL

A simple and clean ToDo List web app built using PHP, MySQL, and Bootstrap.

## 🚀 Features
- ✅ Add new tasks
- 🖋️ Edit existing tasks
- 📌 Mark tasks as complete
- 🗑️ Delete tasks
- ✨ Bootstrap UI
- 💾 Data stored in MySQL

## 🛠️ Tech Stack
- Frontend: HTML, CSS, Bootstrap 5
- Backend: PHP (Core)
- Database: MySQL (via XAMPP)

## 📷 Screenshot

![todo-app-screenshot](screenshot.png)

## 🏁 How to Run

1. Install XAMPP
2. Place the project in `htdocs` folder
3. Start Apache & MySQL from XAMPP
4. Create a MySQL database named `todo_db`
5. Import the table:

```sql
CREATE TABLE `todos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `task` varchar(255) NOT NULL,
  `status` enum('pending','completed') NOT NULL DEFAULT 'pending',
  PRIMARY KEY (`id`)
);
