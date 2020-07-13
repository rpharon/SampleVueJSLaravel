<template>
    <tr>
        <td>{{ customer.id }}</td>
        <td>{{ customer.firstname }} {{ customer.lastname }}</td>
        <td>{{ customer.email }}</td>
        <td>{{ customer.phone_number }}</td>
        <td>
            <div>
                <button class="mini ui blue button" @click="onEdit">Edit</button>
                <button class="mini ui red button" @click="onDelete">Delete</button>                
            </div>
            <!-- <div>
                <button class="mini ui green button" @click="onEmail">Email</button>
                <button class="mini ui yellow button" @click="onSMS">SMS</button>
            </div> -->
        </td>
    </tr>
</template>

<script>
export default {
    name: "Customer",
    props:{
        customer:{
            type: Object
        }
    },
    methods:{
    }
}
</script>

<style scoped>

</style>