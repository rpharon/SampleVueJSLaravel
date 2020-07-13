<template>
    <div id="app">
        <div class="ui fixed inverted menu vue-color">
            <div class="ui container">
                <a href="#" class="header item">Vue JS CRUD with Laravel API's</a>
            </div>
        </div>

        <div class="ui main container">
            <MyForm :form="form" @onFormSubmit="onFormSubmit"/>
            <Loader v-if="loader"/>
            <CustomerList :customers="customers" 
                @onDelete="onDelete"
                @onEdit="onEdit"
            />
        </div>
    </div>
</template>

<script>
import axios from "axios";
import MyForm from "./components/MyForm";
import CustomerList from "./components/CustomerList";
import Loader from "./components/Loader";

export default {
    name: 'App',
    components:{ 
        MyForm,
        CustomerList,
        Loader
    },
    data(){
        return{
            url: "http://vuelaravel.test/api/customer",
            customers: [],
            form: {
                firstname: "", 
                lastname: "", 
                email: "",
                phone_number: "",
                sms_body: "",
                email_body: "",
                isEdit: false
            },
            loader: false
        }
    },
    methods:{
        getCustomers(){
            this.loader = true;

            axios.get(this.url).then(data =>{
                this.customers = data.data.data;
                this.loader = false;
            });
        },
        createCustomer(data){
            axios.post(this.url,{
                firstname : data.firstname,
                lastname : data.lastname,
                email : data.email,
                phone_number: data.phone_number,
                sms_body: data.sms_body,
                email_body: data.email_body
            }).then(() => {
                
                this.getCustomers();
            })
            .catch(e => {
                alert(e);
            });
        },
        editCustomer(data){
            this.loader = true;

            axios.put(`${this.url}/${data.id}`, {
                firstname: data.firstname,
                lastname: data.lastname,
                email: data.email,
                phone_number: data.phone_number,
                sms_body: data.sms_body,
                email_body: data.email_body
            })
            .then(data =>{
                this.getCustomers();
            })
            .catch(e => {
                alert(e);
            });
        },
        deleteCustomer(id){
            axios.delete(`${this.url}/${id}`)
            .then(data =>{
                this.getCustomers();
            });
        },
        onDelete(id){
            this.deleteCustomer(id);
        },
        onEdit(data){
            this.form = data;
            this.form.isEdit = true;
        },
        onFormSubmit(data){
            if(data.isEdit){
                //edit customer
                 this.editCustomer(data);
            }
            else{
                //create customer
                this.createCustomer(data);
            }
        }
    },
    created(){
        this.getCustomers();
    }
}
</script>

<style>
.vue-color{
    background: #41b883 !important;
}

.main.container{
    margin-top: 70px;
}

.submit-button{
    margin-top: 24px !important;
    float:  right;
}

.data{
    margin-top: 15px;
}

thead tr th{
    background: #e0e0e0 !important;
}

.ui.inverted.dimmer{
    background-color: rgba(255, 255, 255, 0) !important;
}
</style>