<script lang="ts">
import {defineComponent} from 'vue';
import axios from "axios";

export default defineComponent({
    data: () => ({
        hasSaved: false,
        errorMessages: '',
        isFormValid: undefined,
        devName: null,
        devModel: undefined,
        udi: null,
        device: {
            name: '',
            udi: ''
        },
        states: [
            {name: 'esp-wroom-32', abbr: 'ESP-32', id: 1},
            {name: 'Arduino Nano', abbr: 'ARDUINO', id: 2},
        ],
    }),
    computed: {
        form() {
            return {
                name: '',
                udi: ''
            }
        },
    },
    watch: {
        name() {
            this.errorMessages = ''
        },
    },
    methods: {
        createDevice() {
            axios.post('api/devices', this.device)
                .then((res) => {
                    this.devModel = res.data.devName;
                    console.log(res);
                    this.hasSaved = true
                    this.resetForm()
                })
                .catch((err) => console.error(err));
        },
        resetForm() {
            this.errorMessages = ''
            Object.keys(this.form).forEach(f => {
                (this.$refs[f] as any).reset()
            })
        },
    },
})
</script>

<template>
    <v-card
        ref="form"
        class="ma-5"
        max-width="600"
    >
        <v-toolbar class="px-2" flat>
            <v-icon size="x-large" icon="mdi-chip"/>
            <v-toolbar-title class="font-weight-light">
                Add Device
            </v-toolbar-title>
        </v-toolbar>
        <v-form ref="form" v-model="isFormValid" @submit.prevent="createDevice()">
            <v-card-text>
                <v-text-field
                    ref="name"
                    v-model="device.name"
                    :error-messages="errorMessages"
                    label="Name"
                    :rules="[() => !!device.name || 'This field is required']"
                ></v-text-field>

                <v-text-field
                    ref="udi"
                    v-model="device.udi"
                    label="UDI"
                    max="8"
                    :rules="[
                      () => !!device.udi || 'This field is required',
                      () => !!device.udi && device.udi.length == 8 || 'UDI must be 8 characters'
                    ]"
                ></v-text-field>

                <v-autocomplete
                    v-model="devModel"
                    :items="states"
                    item-title="name"
                    item-value="abbr"
                    label="Model"
                ></v-autocomplete>
            </v-card-text>

            <v-divider></v-divider>

            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn :disabled="!isFormValid" text="Save" type="submit"/>
            </v-card-actions>
        </v-form>
        <v-snackbar
            v-model="hasSaved"
            :timeout="2000"
            location="bottom left"
            position="absolute"
            attach
        >Device {{ devModel }} added successfully
        </v-snackbar>
    </v-card>
</template>


