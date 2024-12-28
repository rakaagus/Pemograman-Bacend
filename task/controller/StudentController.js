const students = require('../data/students');
const Student = require('../model/Student');

class StudentController {
    async index(req, res) {
        const students = await Student.all();
        
        const data = {
            message: "Manampilkan semua students",
            data: students
        }

        res.json(data);
    }

    async store(req, res) {
        const student = await Student.create(req.body);

        const data = {
            message: `Menambahkan data student`,
            data: student,
        }
        res.json(data);
    }

    update(req, res) {
        const {id} = req.params;
        const {nama} = req.body;
        const student = students.find((s) => s.id == parseInt(id));

        if(student){

            student.nama = nama || student.nama;

            res.json(
                {
                    message: `Mengedit student id ${id}, nama ${nama}`,
                    data: student,
                }
            ).status(200);
        }else {
            res.json({
                    message: `Data student tidak ditemukan`,
                }
            ).status(404);
        }
    }

    destroy(req, res) {
        const {id} = req.params;
        const index = students.findIndex((s) => s.id === parseInt(id));
        
        if(index !== -1){
            const deletedStudent = students.splice(index, 1);
            res.json(
                {
                    message: `Menghapus student id ${id}`,
                    data: deletedStudent
                }
            );
        }else {
            res.status(404).json({ message: 'Data student tidak ditemukan' });
        }
    }
}

const object = new StudentController();

module.exports = object;