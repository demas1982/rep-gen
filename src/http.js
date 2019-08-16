import axios from 'axios'

export const http = axios.create({
    baseURL: 'public/rep_gen.php'
})