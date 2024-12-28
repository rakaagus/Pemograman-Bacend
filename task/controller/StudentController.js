const students = require('../data/students');
const Student = require('../model/Student');

class StudentController {
    async index(req, res) {
        const students = await Student.all();
        
        if(students.length > 0){
            const data = {
                message: "Manampilkan semua students",
                data: students
            }
    
            res.json(data);
        }else {
            const data = {
                message: "Tidak ada data student"
            }
    
            res.json(data);
        }
    }

    async store(req, res) {

        const {nama, nim, email, jurusan} = req.body;

        if(!nama || !nim || !email || !jurusan){
            const data = {
                message: `Semua Data harus dikirim`
            }
            res.json(data).status(422);
        }

        const student = await Student.create(req.body);

        const data = {
            message: `Menambahkan data student`,
            data: student,
        }
        res.json(data);
    }

    async update(req, res) {
        const {id} = req.params;
        
        const student = await Student.find(id);

        if(student){

            const updateStudent = await Student.update(id, req.body);

            res.json(
                {
                    message: `Mengedit student id ${id}`,
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

    async destroy(req, res) {
        const {id} = req.params;
        const student = Student.find(id);
        
        if(student){
            await Student.delete(id);
            res.json(
                {
                    message: `Menghapus student id ${id}`,
                }
            );
        }else {
            res.status(404).json({ message: 'Data student tidak ditemukan' });
        }
    }

    async show(req, res){
        const {id} = req.params;

        const student = await Student.find(id);

        if(student){
            const data = {
                message: "Menampilkan detail student",
                data: student
            };

            res.json(data).status(200);
        }else {
            const data = {
                message: "Student tidak ada",
            };

            res.json(data).status(404);
        }
    }
}

const object = new StudentController();

module.exports = object;