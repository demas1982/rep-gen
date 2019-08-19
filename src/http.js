import axios from 'axios'

export const http = axios.create({
    //baseURL: 'rep_gen.php'
    baseURL: 'public/rep_gen.php'
})