<template>
    <div class="customer-list">
        <div class="data">
            <table class="ui celled table">
                <thead>
                    <tr>
                        <th style="width: 50px; text-align: center;">#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th style="width: 200px;">Action</th>
                    </tr>
                </thead>

                <tbody>
                    <Customer v-for="customer in customers" 
                    :key="customer.id"
                    :customer="customer"
                    @onDelete="onDelete"
                    @onEdit="onEdit"
                    />
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import Customer from "./Customer"

export default {
    name: "CustomerList",
    components:{
        Customer
    },
    props:{
        customers:{
            type: Array
        }
    },
    methods:{
        onDelete(id){
            this.$emit("onDelete", id);
        },
        onEdit(data){
            this.$emit("onEdit", data);
        }
    }
}
</script>

<style scoped>

</style>