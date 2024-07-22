<script lang="ts">
import {defineComponent} from "vue";
import axios from "axios";

let token = document.head.querySelector('meta[name="csrf-token"]');

axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';


export default defineComponent({
    data () {
        return {
            todos: [],
            visibility: '',
        }
    },

        mounted () {
            this.visibility = 'all'
            axios.get('todo/get',{
            }).then((response)=>{
                this.todos = response.data.todo
                console.log(this.todos)
            })
        }

})

</script>

<template>
    <section class="main" v-show="todos.length" v-cloak>
        <input id="toggle-all" class="toggle-all" type="checkbox">
        <label for="toggle-all"></label>
        <ul class="todo-list">
            <li v-for="todo in todos"
                class="todo"
                :key="todo.id"
             >
            </li>
        </ul>
    </section>
</template>

<style scoped>

</style>
