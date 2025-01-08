new Vue({
    el:"#app",
    data:{
        newItem:[],
        msg:"",
        students:{},
        groups:{}
    },
    mounted:function(){
        this.getData();
    },
    methods:{
        getData:function(){
            let self = this;
            axios.get("/index.php/students/getData").then(function(response){
                if(response.data.students) self.students = response.data.students;
                if(response.data.groups) self.groups = response.data.groups;
            });
        },
        toFormData:function(obj){
            let fd = new FormData();
            for(let i in obj){
                fd.append(i,obj[i]);
            }
            return fd;
        },
        addStudent:function(){
            if (this.newItem) {
                let self = this;
                let formData = this.toFormData(this.newItem);
                axios.post("/index.php/students/addStudent",formData).then(function(response){
                    self.getData();
                    self.newItem=[];
                    self.msg = "Студент успешно добавлен";
                    setTimeout(function(){self.msg="";},5000);
                });
            }
        },
        updateStudent:function(student){
            if(student){
                let self = this;
                let formData = this.toFormData(student);
                formData.append('update',student.id);

                axios.post("/index.php/students/actions",formData).then(function(){
                    self.getData();
                    self.newItem=[];
                    self.msg = "Студент успешно изменён";
                    setTimeout(function(){self.msg="";},5000);
                });
            }
        },
        deleteStudent:function(student){
            if(student){
                let self = this;
                let formData = this.toFormData(student);
                formData.append('delete',student.id);

                axios.post("/index.php/students/actions",formData).then(function(){
                    self.getData();
                    self.newItem=[];
                    self.msg = "Студент успешно удалён";
                    setTimeout(function(){self.msg="";},5000);
                });
            }
        },
    }
});