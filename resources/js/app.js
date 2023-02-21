class Service {
    constructor() {
        this.token = this.getToken();
        this.taskAccept = '/tasks/accept'
    }


    acceptTask = (id) => {

        // fetch('/tasks/accept', {
        //     method: 'PUT',
        //         headers: {
        //             'X-CSRF-Token': this.token
        //         },
        // }).then((data) => data.json())
        //     .then(data => console.log(data))

        const body = {
            id: id
        }
        console.log(body)
        const options = {
            method: 'PUT',
            headers: {
                'Content-type': 'application/json; charset=UTF-8',
                'X-CSRF-Token': this.token
            },
            body:  JSON.stringify(body)
        }

        const data = this.getData(this.taskAccept, options);
    }


    getData = async (api, data) => {
        fetch(api, data)
            .then((data) => data.json())
            .then((body) => console.log(body))
    }

    getToken() {
        return document.querySelector('[name="csrf-token"]').content
    }
}

class UserMenu {
    constructor(idUserBtn, idUserMenu) {
        this.$userBtn = document.querySelector(idUserBtn);
        this.$userMenu = document.querySelector(idUserMenu);
        this.init()
    }

    init = () => {
        if (!this.$userBtn || !this.$userMenu) return
        this.listeners();
    }
    open = () => {
        this.$userMenu.classList.add('open');
        this.$userMenu.dataset.menuStatus = 'open';
    }
    close = () => {
        this.$userMenu.classList.remove('open');
        this.$userMenu.dataset.menuStatus = 'close';
    }

    toggleMenu = (e) => {
        if (e.target.closest('#userMenu')) return;
        if (e.target.closest('#userBtn') && this.$userMenu.dataset.menuStatus === 'close') {
            this.open();
            return;
        }
        if (this.$userMenu.dataset.menuStatus === 'open') {
            this.close();
            return;
        }
    }

    listeners = () => {
        document.addEventListener('click', this.toggleMenu);
    }
}


class Select {
    constructor() {
        this.init()

    }

    init() {
        this.listeners()
    }


    open = ($select) => {
        this.closeAll();
        $select.classList.add('open');
        $select.dataset.select = 'open';
    }

    close = ($select) => {
        $select.classList.remove('open');
        $select.dataset.select = 'close';
    }

    closeAll = () => {
        const $selectList = document.querySelectorAll('[data-select]');
        $selectList.forEach( ($select) =>  this.close($select));
    }


    toggleSelect = ($select) => {

        if ($select.dataset.select === 'open') {
            this.close($select)
        } else {
            this.open($select)
        }
        // if(e.target.closest('[data-select-btn]')){
        //     const $select = e.target.closest('[data-select]');
        //     $select.classList.toggle('open');
        // }
    }

    changeTitle = ($input) => {
        const $select = $input.closest('[data-select]');
        const $selectTitle = $select.querySelector('[data-select-title]');
        const title = $input.dataset.label;
        $selectTitle.innerHTML = title;
    }

    clickHandler = (e) => {

        if (e.target.closest('[data-select-btn]')) {
            this.toggleSelect(e.target.closest('[data-select]'))
        }

        if (!e.target.closest('[data-select-btn]')) {
            this.closeAll();
        }
    }

    changeHandler = (e) => {
        if(e.target.closest('[data-select]')){
            this.changeTitle(e.target)
        }
    }

    listeners = () => {
        document.addEventListener('click', this.clickHandler);
        document.addEventListener('change', this.changeHandler);
    }
}

class Task{
    constructor() {
        this.init()
    }

    init = () => {
        this.listeners();
    }

    acceptTask = async ($btnAccept) => {
        const $task = $btnAccept.closest('[data-task-id]');
        const id =  $task.dataset.taskId;
        const response = await service.acceptTask(id);
    }

    clickHandler = (e) => {
        if(e.target.closest('[data-assept]')){
            this.acceptTask(e.target.closest('[data-assept]'))
        }
    }
    listeners = () => {
        document.addEventListener('click', this.clickHandler);
    }
}


const service = new Service();
const userMenu = new UserMenu('#userBtn', '#userMenu');
const select = new Select();
const task = new Task();
