// Компонент "Студенти"
const Students = {
    data() {
        return {
            students: [],
            groups: [],
            newItem: { name: '', group_id: '' },
            msg: '',
            errorMsg: ''
        };
    },
    mounted() {
        this.getData();
    },
    methods: {
        toFormData:function(obj){
            let fd = new FormData();
            for(let i in obj){
                fd.append(i,obj[i]);
                console.log(i);
                console.log(obj[i]);
            }
            return fd;
        },
        getData() {
            axios.get('http://pr9:81/index.php/students/getData')
            .then(response => {
                    this.students = response.data.students || [];
                    this.groups = response.data.groups || [];
                })
                .catch(() => {
                    this.errorMsg = 'Не вдалося отримати дані. Спробуйте пізніше.';
                    setTimeout(() => this.errorMsg = '', 5000);
                });
        },
        addStudent() {
            if (!this.newItem.name.trim() || !this.newItem.group_id) {
                this.errorMsg = 'Будь ласка, заповніть всі поля!';
                setTimeout(() => this.errorMsg = '', 5000);
                return;
            }

            const formData = new FormData();
            for (let key in this.newItem) {
                formData.append(key, this.newItem[key]);
            }

            axios.post('http://pr9:81/index.php/students/addStudent', formData)
                .then(() => {
                    this.getData();
                    this.newItem = { name: '', group_id: '' };
                    this.msg = 'Студент успішно доданий';
                    setTimeout(() => this.msg = '', 5000);
                })
                .catch(() => {
                    this.errorMsg = 'Не вдалося додати студента. Спробуйте пізніше.';
                    setTimeout(() => this.errorMsg = '', 5000);
                });
        },
        updateStudent(student) {
            if (!student.name.trim()) {
                this.errorMsg = 'Ім\'я студента не може бути порожнім!';
                setTimeout(() => this.errorMsg = '', 5000);
                return;
            }
            const formData = this.toFormData(student);
            formData.append('update',student.id);

            axios.post('http://pr9:81/index.php/students/actions', formData)
                .then((response) => {
                    console.log(response);
                    this.getData();
                    this.msg = 'Студент успішно оновлений';
                    setTimeout(() => this.msg = '', 5000);
                })
                .catch(() => {
                    this.errorMsg = 'Не вдалося оновити студента. Спробуйте пізніше.';
                    setTimeout(() => this.errorMsg = '', 5000);
                });
        },
        deleteStudent(student) {
            const formData = new FormData();
            formData.append('delete', student.id);

            axios.post('http://pr9:81/index.php/students/actions', formData)
                .then(() => {
                    this.getData();
                    this.msg = 'Студент успішно видалений';
                    setTimeout(() => this.msg = '', 5000);
                })
                .catch(() => {
                    this.errorMsg = 'Не вдалося видалити студента. Спробуйте пізніше.';
                    setTimeout(() => this.errorMsg = '', 5000);
                });
        }
    },
    template: `
    <div>
    <h1>Студенти</h1>
    <form @submit.prevent="addStudent">
        <input 
            v-model="newItem.name" 
            type="text" 
            placeholder="Ім'я" 
            required 
        />
        <select v-model="newItem.group_id" required>
            <option value="" disabled>Оберіть групу</option>
            <option v-for="group in groups" :value="group.id">{{ group.name }}</option>
        </select>
        <button type="submit">Додати студента</button>
    </form>
    <!-- Уведомления -->
    <p v-if="msg" class="success">{{ msg }}</p>
    <p v-if="errorMsg" class="error">{{ errorMsg }}</p>
    <!-- Таблица студентов -->
    <table v-if="students.length">
        <thead>
            <tr>
                <th>Ім'я</th>
                <th>Група</th>
                <th>Дії</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="student in students" :key="student.id">
                <td><input type="text" v-model="student.name"></td>
                <td>
                    <select v-model="student.group_id" v-if="groups.length > 0">
                        <option v-for="group in groups" :value="group.id" :key="group.id">
                            {{ group.name }}
                        </option>
                    </select>
                </td>
                <td>
                    <button type="submit" @click.prevent="updateStudent(student)">Обновить</button>
                    <button @click.prevent="deleteStudent(student)">Видалити</button>
                </td>
            </tr>
        </tbody>
    </table>
    <!-- Сообщение, если список студентов пуст -->
    <p v-else>Немає студентів</p>
</div>
    `
};

// Компонент "Предмети"
const Subjects = {
    data() {
        return {
            subjects: [],
            newSubject: { name: '' },
            msg: '',
            errorMsg: ''
        };
    },
    mounted() {
        this.getSubjects();
    },
    methods: {
        toFormData: function (obj) {
            let fd = new FormData();
            for (let key in obj) {
                if (obj.hasOwnProperty(key)) {
                    fd.append(key, obj[key]);
                }
            }
            return fd;
        },
        getSubjects() {
            axios.get('http://pr9:81/index.php/subjects/getData')
                .then(response => {
                    this.subjects = response.data.subjects || [];
                })
                .catch(() => {
                    this.errorMsg = 'Не вдалося отримати дані. Спробуйте пізніше.';
                    setTimeout(() => (this.errorMsg = ''), 5000);
                });
        },
        addSubject() {
            if (!this.newSubject.name.trim()) {
                this.errorMsg = 'Назва предмету не може бути порожньою!';
                setTimeout(() => (this.errorMsg = ''), 5000);
                return;
            }

            const formData = new FormData();
            for (let key in this.newSubject) {
                formData.append(key, this.newSubject[key]);
            }
            axios.post('http://pr9:81/index.php/subjects/addSubject', formData)
                .then(() => {
                    this.getSubjects();
                    this.newSubject = { name: '' };
                    this.msg = 'Предмет успішно додано';
                    setTimeout(() => (this.msg = ''), 5000);
                })
                .catch(() => {
                    this.errorMsg = 'Не вдалося додати предмет. Спробуйте пізніше.';
                    setTimeout(() => (this.errorMsg = ''), 5000);
                });
        },
        updateSubject(subject) {
            if (!subject.name.trim()) {
                this.errorMsg = 'Назва предмету не може бути порожньою!';
                setTimeout(() => (this.errorMsg = ''), 5000);
                return;
            }
            subject.name=subject.name.trim();
            console.log('Updating subject:', subject);
            const formData = this.toFormData(subject);
            formData.append('update',subject.id);
            for (let pair of formData.entries()) {
                console.log(pair[0] + ': ' + pair[1]);
            }
            axios.post('http://pr9:81/index.php/subjects/actions', formData)
                .then((response) => {
                    console.log(response);
                    for (let pair of formData.entries()) {
                        console.log(pair[0] + ': ' + pair[1]);
                    }
                    this.getSubjects();
                    this.msg = 'Предмет успішно оновлено';
                    setTimeout(() => (this.msg = ''), 5000);
                })
                .catch(() => {
                    this.errorMsg = 'Не вдалося оновити предмет. Спробуйте пізніше.';
                    setTimeout(() => (this.errorMsg = ''), 5000);
                });
        },
        deleteSubject(subject) {
            const formData = new FormData();
            formData.append('delete', subject.id);

            axios.post('http://pr9:81/index.php/subjects/actions', formData)
                .then(() => {
                    this.getSubjects();
                    this.msg = 'Предмет успішно видалено';
                    setTimeout(() => (this.msg = ''), 5000);
                })
                .catch(() => {
                    this.errorMsg = 'Не вдалося видалити предмет. Спробуйте пізніше.';
                    setTimeout(() => (this.errorMsg = ''), 5000);
                });
        }
    },
    template: `
        <div>
            <h1>Предмети</h1>
            <form @submit.prevent="addSubject">
                <input 
                    v-model="newSubject.name" 
                    type="text" 
                    placeholder="Введіть назву предмета" 
                    required 
                />
                <button type="submit">Додати предмет</button>
            </form>
            <!-- Уведомлення -->
            <p v-if="msg" class="success">{{ msg }}</p>
            <p v-if="errorMsg" class="error">{{ errorMsg }}</p>
            <!-- Таблиця предметів -->
            <table v-if="subjects.length">
                <thead>
                    <tr>
                        <th>Назва предмету</th>
                        <th>Дії</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="subject in subjects" :key="subject.id">
                        <td>
                            <input type="text" v-model="subject.name"  />
                        </td>
                        <td>
                            <button @click.prevent="updateSubject(subject)">Обновить</button>
                            <button @click.prevent="deleteSubject(subject)">Видалити</button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <!-- Повідомлення, якщо список предметів порожній -->
            <p v-else>Немає предметів</p>
        </div>
    `
};

// Компонент "Успішність"
const Uspishnist = {
    data() {
        return {
            uspishnist: [],
            students: [],
            subjects: [],
            search : '',
            newItem: { sid: '', pid: '', mark: '' },
            msg: '',
            errorMsg: ''
        };
    },
    mounted() {
        this.getData();
    },
    methods: {
        toFormData: function (obj) {
            let fd = new FormData();
            for (let key in obj) {
                if (obj.hasOwnProperty(key)) {
                    fd.append(key, obj[key]);
                }
            }
            return fd;
        },
        getData() {
            axios.get('http://pr9:81/index.php/uspishnist/getData')
                .then(response => {
                    this.uspishnist = response.data.uspishnist || [];
                    this.students = response.data.students || [];
                    this.subjects = response.data.subjects || [];
                })
                .catch(() => {
                    this.errorMsg = 'Не вдалося отримати дані. Спробуйте пізніше.';
                    setTimeout(() => (this.errorMsg = ''), 5000);
                });
        },
        searchStudent() {
            if (!this.search.trim()) {
               this.getData();
               return;
            }
            console.log(this.search);
            const formData = new FormData();
            formData.append('search', this.search);
            axios.get(`http://pr9:81/index.php/uspishnist/getData?search=${this.search}`)
            .then(response => {
                this.uspishnist = response.data.uspishnist || [];
                if (this.uspishnist.length === 0) {
                    this.msg = 'Нічого не знайдено.';
                    setTimeout(() => (this.msg = ''), 5000);
                }
            })
                .catch(() => {
                    this.errorMsg = 'Помилка під час пошуку. Спробуйте пізніше.';
                    setTimeout(() => (this.errorMsg = ''), 5000);
                });
        },
        addUspishnist() {
            if (!this.newItem.sid || !this.newItem.pid || !this.newItem.mark.trim()) {
                this.errorMsg = 'Будь ласка, заповніть всі поля!';
                setTimeout(() => (this.errorMsg = ''), 5000);
                return;
            }
            const formData = this.toFormData(this.newItem);

            axios.post('http://pr9:81/index.php/uspishnist/add', formData)
                .then(() => {
                    this.getData();
                    this.newItem = { sid: '', pid: '', mark: '' };
                    this.msg = 'Запис успішно доданий';
                    setTimeout(() => (this.msg = ''), 5000);
                })
                .catch(() => {
                    this.errorMsg = 'Не вдалося додати запис. Спробуйте пізніше.';
                    setTimeout(() => (this.errorMsg = ''), 5000);
                });
        },
        updateUspishnist(item) {
            if (!item.mark.trim()) {
                this.errorMsg = 'Оцінка не може бути порожньою!';
                setTimeout(() => (this.errorMsg = ''), 5000);
                return;
            }

            const formData = this.toFormData(item);
            formData.append('update', item.id);

            axios.post('http://pr9:81/index.php/uspishnist/actions', formData)
                .then(() => {
                    this.getData();
                    this.msg = 'Запис успішно оновлений';
                    setTimeout(() => (this.msg = ''), 5000);
                })
                .catch(() => {
                    this.errorMsg = 'Не вдалося оновити запис. Спробуйте пізніше.';
                    setTimeout(() => (this.errorMsg = ''), 5000);
                });
        },
        deleteUspishnist(item) {
            const formData = new FormData();
            formData.append('delete', item.id);

            axios.post('http://pr9:81/index.php/uspishnist/actions', formData)
                .then(() => {
                    this.getData();
                    this.msg = 'Запис успішно видалений';
                    setTimeout(() => (this.msg = ''), 5000);
                })
                .catch(() => {
                    this.errorMsg = 'Не вдалося видалити запис. Спробуйте пізніше.';
                    setTimeout(() => (this.errorMsg = ''), 5000);
                });
        }
    },
    template: `
    <div>
        <h1>Успішність</h1>
        <form @submit.prevent="addUspishnist">
            <select v-model="newItem.sid" required>
                <option value="" disabled>Оберіть студента</option>
                <option v-for="student in students" :value="student.id">
                    {{ student.name }}
                </option>
            </select>
            <select v-model="newItem.pid" required>
                <option value="" disabled>Оберіть предмет</option>
                <option v-for="subject in subjects" :value="subject.id">
                    {{ subject.name }}
                </option>
            </select>
            <input 
                type="number" 
                v-model="newItem.mark" 
                placeholder="Введіть оцінку" 
                required 
            />
            <button type="submit">Додати</button>
        </form>
        <form @submit.prevent="searchStudent">
        <input 
            type="text" 
            v-model="search" 
            placeholder="Пошук студента за ім'ям" 
        />
        <button type="submit">Пошук</button>
        </form>
        <p v-if="msg" class="success">{{ msg }}</p>
        <p v-if="errorMsg" class="error">{{ errorMsg }}</p>
        <table v-if="uspishnist.length">
            <thead>
                <tr>
                    <th>Студент</th>
                    <th>Предмет</th>
                    <th>Оцінка</th>
                    <th>Дії</th>
                </tr>
            </thead>
            <tbody>
                <tr v-if="uspishnist" v-for="item in uspishnist" :key="item.id">
                    <td>
                        <select v-model="item.sid">
                            <option v-for="student in students" :value="student.id">
                                {{ student.name }}
                            </option>
                        </select>
                    </td>
                    <td>
                        <select v-model="item.pid">
                            <option v-for="subject in subjects" :value="subject.id">
                                {{ subject.name }}
                            </option>
                        </select>
                    </td>
                    <td>
                        <input 
                            type="number" 
                            v-model="item.mark" 
                            required 
                        />
                    </td>
                    <td>
                        <button @click.prevent="updateUspishnist(item)">Оновити</button>
                        <button @click.prevent="deleteUspishnist(item)">Видалити</button>
                    </td>
                </tr>
            </tbody>
        </table>
        <p v-else>Немає записів успішності</p>
    </div>
    `
};


const routes = [
    { path: '/', component: Students },
    { path: '/subjects', component: Subjects },
    { path: '/uspishnist', component: Uspishnist },
    { path: '/:pathMatch(.*)*', redirect: '/' } 
];

const router = new VueRouter({ routes });

new Vue({
    el: '#app',
    router
});
