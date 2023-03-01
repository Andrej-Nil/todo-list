class Service {
    constructor() {
        this.token = this.getToken();
        this.POST = 'POST';
        this.GET = 'GET';
    }

    getData = async (api, options) => {
        const response = await fetch(api, options);
        if (response.ok) {
            return await response.json()
        } else {
            return this.createError(response)
        }
    }

    createError = (response) => {
        return {
            status: 'error',
            url: response.url,
            error: {
                ok: response.ok,
                status: response.status,
                statusText: response.statusText
            }
        }
    }

    createOptions = (method, body) => {
        const options = {
            method: method,
            headers: {
                'content-type': 'application/json; charset=UTF-8',
                'X-CSRF-Token': this.token
            }
        }
        if (body) options.body = JSON.stringify(body);
        return options;
    }

    getToken() {
        return document.querySelector('[name="csrf-token"]').content
    }


}

class Render {
    getListHtml = (getHtmlFn, arr) => {
        let list = '';
        arr.forEach((item) => {
            list += getHtmlFn(item);
        })

        return list;
    }

    _render = ($parent, getHtmlMarkup, argument = false, array = false, where = 'beforeend') => {
        let markupAsStr = '';
        if (!$parent) {
            return;
        }
        if (array) {
            array.forEach((item) => {
                markupAsStr = markupAsStr + getHtmlMarkup(item);
            })
        }
        if (!array) {
            markupAsStr = getHtmlMarkup(argument);
        }
        $parent.insertAdjacentHTML(where, markupAsStr);
    }

    clearParent = ($parent) => {
        if (!$parent) {
            return;
        }
        $parent.innerHTML = '';
    }

    delete = ($el) => {
        if (!$el) {
            return;
        }
        $el.remove()
    }

}

class Spinner extends Render {
    render = ($parent,) => {

    }


    mark = () => {
        return (`

        `)
    }

    delete = ($parent) => {
        this.clearParent($parent);
    }
}

class Body {
    constructor() {
        this.$body = document.querySelector('body');
    }

    scrollOff = () => {
        this.$body.classList.add('scroll-off')
    }

    scrollOn = () => {
        this.$body.classList.remove('scroll-off')
    }
}

class ModalRender extends Render {
    constructor($content) {
        super();
        this.$content = document.querySelector('#modalContent');
    }

    contentRender = (getHtmlFn, data = false) => {
        this._render(this.$content, getHtmlFn, data)
    }

    clearContent = () => {
        this.clearParent(this.$content);
    }
}

class Modal extends ModalRender {
    constructor(modalId) {
        super();
        this.$modal = document.querySelector(modalId);
        this.init();
    }

    init = () => {
        if (!this.$modal) return;
        this.body = new Body();
        this.listeners();
    }

    open = (getHtmlFn) => {
        this.$modal.classList.add('forefront');
        this.$modal.classList.add('open');
        this.body.scrollOff();
        this.contentRender(getHtmlFn);
    }

    close = () => {
        this.$modal.classList.remove('open');
        setTimeout(() => {
            this.$modal.classList.remove('forefront');
            this.body.scrollOn();
            this.clearContent();
        }, 200)
    }

    clickHandler = (e) => {
        if (e.target.closest('[data-modal-close]')) {
            this.close();
        }
    }
    listeners = () => {
        document.addEventListener('click', this.clickHandler);

    }
}

class TaskService extends Service {

    getTask = async (taskId) => {
        const options = this.createOptions(this.POST);
        return await this.getData(`/tasks/${taskId}`, options);
    }

    // acceptTask = (id) => {
    //     const body = {
    //         id: id
    //     }

    //
    //     const data = this.getData(this.taskAccept, options);
    // }

}

class TaskRender extends Render {



    getTaskHtml = (task) => {
        const { id, title, desc, status, displayBtn, info } = task;
        const btn = displayBtn ? this.getBtnHtml(status) : '';
        const infoItems = this.getListHtml(this.getInfoItemHtml, info)
        return `
            <div data-task-id="${id}" class="task">
                <h2 class="task__title">${title}</h2>
                <div class="task__content">

                    <p class="task__description">${desc}</p>

                    <div class="task-info">
                        <ul class="task-info__list">
                            ${infoItems}
                        </ul>
                    </div>
                </div>

                <div class="task__controls">

                    ${btn}
                </div>
            </div>
         `

    }

    getTaskSkeletonHtml = () => {
        return `
            <div class="task">
                <h2 class="task__title shine">&nbsp;</h2>
                <div class="task__content">
                    <p class="task__description shine">

                    </p>

                    <div class="task-info">
                        <ul class="task-info__list">
                            <li class="task-info__item shine">&nbsp;</li>
                            <li class="task-info__item shine">&nbsp;</li>
                            <li class="task-info__item shine">&nbsp;</li>
                            <li class="task-info__item shine">&nbsp;</li>
                            <li class="task-info__item shine">&nbsp;</li>
                            <li class="task-info__item shine">&nbsp;</li>
                            <li class="task-info__item shine">&nbsp;</li>
                            <li class="task-info__item shine">&nbsp;</li>
                        </ul>
                    </div>
                </div>
                <div class="task__controls task__controls_empty shine"></div>
            </div>
        `
    }


    getInfoItemHtml = (item) => {

        const {label, value, url} = item

        return `
            <li class="task-info__item">
               <span class="task-info__label">${label}</span>
                ${this.getInfoValueHtml(value, url)}
            </li>
        `
    }

    getInfoValueHtml = (value, url) => {
        if(url) {
            return `<a href="${url}" class="task-info__value link">${value}</a>`
        }

        return `<span class="task-info__value">${value}</span>`
    }


    getBtnHtml = (status) => {


        if(status === 0){
           return '<button data-assept class="btn btn_blue btn_small">Приянть задачу</button>';
        }

        if(status === 1){
            return `
                <button data-pause class="btn btn_yellow btn_small">Приостановить</button>
                <button data-complite class="btn btn_green btn_small">Выполнено</button>
            `;
        }

        if(status === 2){
            return `
                 <button data-pause class="btn btn_yellow btn_small">Продолжить</button>
                 <button data-complite class="btn btn_green btn_small">Выполнено</button>
            `;
        }

        return '';
    }

}

class Task {
    constructor() {
        this.init()
    }

    init = () => {
        this.listeners();
        this.response = null
        this.taskRender = new TaskRender();
        this.taskService = new TaskService();
    }

    // acceptTask = async ($btnAccept) => {
    //     const $task = $btnAccept.closest('[data-task-id]');
    //     const id =  $task.dataset.taskId;
    //     const response = await service.acceptTask(id);
    // }


    showTaskInModal = async ($btn) => {
        this.response = null
        modal.open(this.taskRender.getTaskSkeletonHtml);
        const taskId = $btn.dataset.showInfo;
        this.response = await this.taskService.getTask(taskId);
        this.responseHandler();
    }

    renderTask = () => {
        modal.clearContent();
        modal.contentRender(this.taskRender.getTaskHtml, this.response.data)
    }

    responseHandler = () => {
        if (this.response.status === 'success') {
            this.renderTask()

        }
        if (this.response.status === 'error') {
            console.log(this.response)
        }

    };

    clickHandler = (e) => {
        // if(e.target.closest('[data-assept]')){
        //     this.acceptTask(e.target.closest('[data-assept]'))
        // }
        if (e.target.closest('[data-show-info]')) {
            this.showTaskInModal(e.target.closest('[data-show-info]'));
        }

    }
    listeners = () => {
        document.addEventListener('click', this.clickHandler);
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
        $selectList.forEach(($select) => this.close($select));
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
        if (e.target.closest('[data-select]')) {
            this.changeTitle(e.target)
        }
    }

    listeners = () => {
        document.addEventListener('click', this.clickHandler);
        document.addEventListener('change', this.changeHandler);
    }
}


const modal = new Modal('#modal');
const userMenu = new UserMenu('#userBtn', '#userMenu');
const select = new Select();
const task = new Task();
