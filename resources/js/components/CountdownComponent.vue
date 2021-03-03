<template>
    <div v-if="until">
        <div v-if="finished" v-text="expiredText"></div>
        <div v-else>Remaining Time : {{ remaining.hours }} Hour(s) {{ remaining.minutes }} Minute(s) and
            {{ remaining.seconds }} Seconds
        </div>
    </div>
</template>
<script>
import moment from 'moment';

export default {
    props: {
        until: String,
        expiredText: {default: 'Now Expired'}
    },
    data() {
        return {now: new Date()};
    },
    created() {
        this.refreshEverySecond();
    },
    computed: {

        finished() {
            return this.remaining.total <= 0;
        },
        remaining() {
            let remaining = moment.duration(Date.parse(this.until) - this.now);
            if (remaining <= 0) this.$emit('finished');

            return {
                total: remaining,
                years: this.pad(remaining.years(), 2),
                months: this.pad(remaining.months(), 2),
                days: this.pad(remaining.days(), 2),
                hours: this.pad(remaining.hours(), 2),
                minutes: this.pad(remaining.minutes(), 2),
                seconds: this.pad(remaining.seconds(), 2)
            };
        }
    },
    methods: {
        pad(num, size) {
            var s = "000000000" + num;
            return s.substr(s.length - size);
        },
        refreshEverySecond() {
            let interval = setInterval(() => this.now = new Date(), 1000);
            this.$on('finished', () => clearInterval(interval));
        }
    }
}
</script>
