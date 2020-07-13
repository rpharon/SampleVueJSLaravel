<template>
    <div class="my-form">
        <form class="ui form">
            <div class="fields">
                <div class="four wide field">
                    <label>First Name</label>
                    <input 
                        type="text" 
                        name="firstname" 
                        placeholder="First Name"
                        @change="handleChange"
                        :value="form.firstname"
                    />
                </div>

                <div class="four wide field">
                    <label>Last Name</label>
                    <input 
                        type="text" 
                        name="lastname" 
                        placeholder="Last Name"
                        @change="handleChange"
                        :value="form.lastname"
                    />
                </div>

                <div class="four wide field">
                    <label>E-mail</label>
                    <input 
                        type="email" 
                        name="email"
                        placeholder="harn@gmail.com"
                        @change="handleChange"
                        :value="form.email"
                     />
                </div>

                <div class="four wide field">
                    <label>Phone Number</label>
                    <input 
                        type="text" 
                        name="phone_number"
                        placeholder="Phone Number"
                        @change="handleChange"
                        :value="form.phone_number"
                     />
                </div>

                <div class="two wide field"
                    style="margin-top: auto; padding-left: 50px;">
                    <button :class="btnClass"
                    @click="onFormSubmit">
                    {{ btnName }}
                    </button>
                </div>                
            </div>
            <div class="fields">
                <div class="nine wide field">
                    <label>Send SMS</label>
                    <textarea 
                        type="text" 
                        name="sms_body"
                        placeholder="Enter message here"
                        @change="handleChange"
                        :value="form.sms_body"
                     />
                </div>      
                <div class="nine wide field">
                    <label>Send Email</label>
                    <textarea 
                        type="text" 
                        name="email_body"
                        placeholder="Enter message here"
                        @change="handleChange"
                        :value="form.email_body"
                     />
                </div>                                
            </div>
        </form>
    </div>
</template>

<script>
export default {
    name: "MyForm",
    data(){
        return{
            btnName: "Save",
            btnClass: "ui primary button submit-button;"
        }
    },
    props:{
        form:{
            type: Object
        }
    },
    methods:{
        handleChange(event){
            const{name, value} = event.target;
            let form = this.form;
            form[name] = value;
            this.form = form;
        },
        onFormSubmit(e){
            //prevent form submit
            e.preventDefault();

            //form validation
            if(this.formValidation()){
                this.$emit("onFormSubmit", this.form);

                //change button to save
                this.btnName = "Save",
                this.btnClass = "ui primary button submit-button;"

                //clear fields
                this.clearFormFields();
            }
        },
        formValidation(){
            //firstname
            if(document.getElementsByName("firstname")[0].value === ""){
                alert("Enter first name");
                document.getElementsByName('firstname').style.borderColor = "red";
                return false;
            }

            //lastname
            if(document.getElementsByName("lastname")[0].value === ""){
                alert("Enter last name");
                return false;
            }

            //email
            if(document.getElementsByName("email")[0].value === ""){
                alert("Enter email");
                return false;
            }

            //phone_number
            if(document.getElementsByName("phone_number")[0].value === ""){
                alert("Enter phone number");
                return false;
            }

            //sms_body
            if(document.getElementsByName("sms_body")[0].value === ""){
                alert("Enter sms body");
                return false;
            }
            
            //email_body
            if(document.getElementsByName("email_body")[0].value === ""){
                alert("Enter email body");
                return false;
            }            

            return true;
        },
        clearFormFields(){
            //clear form data
            this.form.firstname = "";
            this.form.lastname = "";
            this.form.email = "";
            this.form.isEdit = false;
            this.form.phone_number = "";
            this.form.sms_body = "";
            this.form.email_body = "";

            //clear fields
            document.querySelector(".form").reset();
        }
    },
    updated(){
        if(this.form.isEdit){
            this.btnName = "Update";
            this.btnClass = "ui orange button submit-button;";
        }
    }
}
</script>

<style scoped>

</style>