class BirdboardForm {
    constructor(data) {
        this.originalData = {};
        this.submitted = false;
        // 对data实现深拷贝
        this.originalData = JSON.parse(JSON.stringify(data));
        // 将传进来的data数据都赋给当前作用域
        Object.assign(this, data);
        // this.data = data;
        this.errors = {};
    }

    data() {
        return Object.keys(this.originalData).reduce((data, attribute) => {
            data[attribute] = this[attribute];

            return data;
        }, {})
        // let data = {};

        // for (let attribute in this.originalData) {
        //     data[attribute] = this[attribute];
        // }

        // return data;
    }

    post(endpoint) {
        this.submit(endpoint);
    }

    patch(endpoint) {
        this.submit(endpoint, 'patch');
    }

    delete(endpoint) {
        this.submit(endpoint, 'delete');
    }

    submit(endpoint, requestType = 'post') {
        return axios[requestType](endpoint, this.data())
            .catch(this.onFail.bind(this))
            .then(this.onSuccess.bind(this));
    }

    onSuccess(response) {
        this.submitted = true;
        this.errors = {};

        return response;
    }

    onFail(error) {
        this.errors = error.response.data.errors;
        this.submitted = false;

        throw error;
    }
}

export default BirdboardForm;