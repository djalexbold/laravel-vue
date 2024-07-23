<script lang="ts">
import {defineComponent, ref} from "vue";
import axios from "axios";

interface deviceType {
    name: string;
    title: string;
}
export default defineComponent({
    data() {
        return {
            loading: true,
            devices: <any>[],
            device: {
                name: '',
                title: ''
            }
        }
    },

    created() {
        this.fetchDeviceList();
    },
    methods: {
        fetchDeviceList() {
            axios.get('api/devices')
                .then((res) => {
                    this.devices = res.data;
                    this.loading = false;
                })
                .catch((err) => console.error(err));
        },

        createDevice() {
            axios.post('api/devices', this.device)
                .then((res) => {
                    console.log(res);
                    this.device.name = '';
                    this.device.title = '';
                })
                .catch((err) => console.error(err));
        },
        deleteDevice(id) {
            axios.delete('api/devices/' + id)
                .then((res) => {
                    this.fetchDeviceList()
                })
                .catch((err) => console.error(err));
        },
    }
})

</script>

<template>
    <v-card max-width="480" class="ma-8">
        <v-form ref="form" @submit.prevent="createDevice()">
            <v-card-text>
                <v-text-field
                    v-model="device.name"
                    label="Имя"
                    name="name"
                    outlined dense
                    hint="Как его будут видеть другие пользователи"

                />
                <v-text-field
                    v-model="device.title"
                    label="Титл"
                    name="title"
                    outlined dense
                />
            </v-card-text>
            <v-card-actions>
                <v-spacer/>
                <v-btn type="submit" color="primary">
                    Добавить
                </v-btn>
            </v-card-actions>
        </v-form>
    </v-card>

    <v-sheet max-width="600" class="ma-8">

        <div class="bg-blue" v-for="item in devices"
            :key="item.id"
        >
            <strong>{{ item.name }}</strong>
            <div>{{ item.title }}</div>
            <v-btn flat @click="deleteDevice(item.id)">Delete</v-btn>
            <v-divider class="ma-2" />
        </div>

    </v-sheet>
</template>

<style scoped>

</style>
