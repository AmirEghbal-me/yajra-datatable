<template>
    <table>
        <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <!-- Add more columns as required -->
        </tr>
        </thead>
        <tbody>
        <tr v-for="user in users" :key="user.id">
            <td>{{ user.name }}</td>
            <td>{{ user.email }}</td>
            <!-- Display other user data -->
        </tr>
        </tbody>
    </table>
</template>

<script>
export default {
    props: {
        users: {
            type: Array,
            required: true
        }
    }
};
</script>
