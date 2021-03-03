<template>
    <div>
        <ul class="list-group" v-for="item in examinations">
            <li class="list-group-item" style="border: none;border-bottom: 1px solid #ddd"
                v-if="item.first_question && item.first_question.length">
                <a href=":javascript;" @click="createSession(item)">{{ item.title }}</a>
            </li>
            <li class="list-group-item" style="border: none;border-bottom: 1px solid #ddd" v-else>
                <a href="">{{ item.title }}</a>
            </li>
        </ul>
    </div>
</template>

<script>
import moment from 'moment';
import {v4 as uuidv4} from 'uuid';

export default {
    props: {
        examinations: Array,
    },

    data() {
        return {}
    },
    mounted() {
    },

    methods: {
        createSession(item) {
            const examEndTime = moment().add(Number(item.exam_time), 'minutes').format('YYYY-MM-DD HH:mm:ss');
            const body = {
                exam_id: item.id,
                candidate_id: 1, //static
                exam_session: uuidv4(),
                exam_end_time: examEndTime
            };
            axios.post('create-session', body)
                .then((response) => {
                    if (response.status === 200) {
                        const session = response.data.data;
                        window.localStorage.setItem('exam_end_time', session.exam_end_time);
                        window.location.href = `/exam/${session.exam_session}/${session.exam_id}/${item.first_question[0]['id']}/${session.candidate_id}`
                    }
                })
        }
    }
}
</script>
