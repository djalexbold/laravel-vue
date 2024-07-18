<script lang="ts">
import { defineComponent } from 'vue';

export default defineComponent({
    data: () => ({
        hasSaved: false,

        states: [
            { name: 'Florida', abbr: 'FL', id: 1 },
            { name: 'Georgia', abbr: 'GA', id: 2 },
            { name: 'Nebraska', abbr: 'NE', id: 3 },
            { name: 'California', abbr: 'CA', id: 4 },
            { name: 'New York', abbr: 'NY', id: 5 },
        ],
    }),

    methods: {
        customFilter (itemTitle, queryText, item) {
            const textOne = item.raw.name.toLowerCase()
            const textTwo = item.raw.abbr.toLowerCase()
            const searchText = queryText.toLowerCase()

            return textOne.indexOf(searchText) > -1 ||
                textTwo.indexOf(searchText) > -1
        },
        save () {
            this.hasSaved = true
        },
    },
})
</script>

<template>
    <v-card
        class="ma-5"
        max-width="600"
    >
        <v-toolbar class="px-2" flat>
            <v-icon size="x-large" icon="mdi-chip" />
            <v-toolbar-title class="font-weight-light">
                Add Device
            </v-toolbar-title>
        </v-toolbar>

        <v-card-text>
            <v-text-field
                base-color="white"
                label="Name"
            ></v-text-field>

            <v-autocomplete
                :custom-filter="customFilter"
                :items="states"
                base-color="white"
                item-title="name"
                item-value="abbr"
                label="State"
            ></v-autocomplete>
        </v-card-text>

        <v-divider></v-divider>

        <v-card-actions>
            <v-spacer></v-spacer>

            <v-btn
                @click="save"
            >
                Save
            </v-btn>
        </v-card-actions>

        <v-snackbar
            v-model="hasSaved"
            :timeout="2000"
            location="bottom left"
            position="absolute"
            attach
        >
            Your profile has been updated
        </v-snackbar>
    </v-card>
</template>


