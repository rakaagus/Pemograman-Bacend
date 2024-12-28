const db = require('../config/database');

class Student {
    static all() {
        return new Promise((resolve, reject) => {
            const query = "SELECT * FROM students";

            db.query(query, (err, results) => {
                resolve(results);
            });
        })
    }

    static async create(data){
        const id = await new Promise((resolve, reject) => {
            const sql = "INSERT INTO students SET ?"
            db.query(sql, data, (err, results) => {
                resolve(results.insertId);
            });
        });

        return new Promise((resolve, reject) => {
            const sql = "SELECT * FROM students where id =?";
            db.query(sql, id, (err, results) => {
                resolve(results);
            });
        });
    }
}

module.exports = Student;