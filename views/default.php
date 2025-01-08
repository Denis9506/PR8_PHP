<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PR9</title>
    <link rel="stylesheet" href="views/style.css">
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>
<div id="app">
<ul>
    <li><a href="/">Студенти</a></li>
    <li><a href="/index.php/subjects">Предмети</a></li>
    <li><a href="/index.php/uspishnist">Успішність</a></li>
</ul>
    <form @submit.prevent="addStudent()">

        <input type="text" v-model="newItem.name" placeholder="Name" required /><br>
        <select v-model="newItem.group_id" v-if="groups" required>
            <option v-for="g in groups" :value="g.id">{{ g.name }}</option>
        </select>
        <br>
        <input type="submit" value="Добавить" />
        <div class="msg" v-if="msg">{{ msg }}</div>

    </form>


    <table v-if="students.length > 0">
        <thead>
            <tr>
                <th>Имя</th>
                <th>Группа</th>
                <th>Действия</th>
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
                    <button type="submit" @click.prevent="deleteStudent(student)">Удалить</button>
                </td>
            </tr>
        </tbody>
    </table>
    <p v-else>Нет студентов</p>
 
</div>
<script src = "./core/script_vue.js"></script>
</body>
</html>
