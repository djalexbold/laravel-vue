<script lang="ts">
import {defineComponent} from "vue";
import axios from "axios";

interface deviceType {
    name: string;
    udi: string;
}

export default defineComponent({
    data() {
        return {
            loading: true,
            devices: <any>[],
            device: {
                name: '',
                udi: ''
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
                    this.device.name = ''
                    this.device.udi = ''
                    this.fetchDeviceList()
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
                    v-model="device.udi"
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
            <div>{{ item.udi }}</div>
            <v-btn flat @click="deleteDevice(item.id)">Delete</v-btn>
            <v-divider class="ma-2"/>
        </div>

    </v-sheet>
</template>

<style scoped>

</style>
