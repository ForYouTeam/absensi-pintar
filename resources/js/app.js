require('./bootstrap');

import { createApp } from 'vue'
import ExportButton from './component/ExportButton.vue'

const app = createApp({})

app.component('exportfunction', ExportButton)

app.mount('#app')