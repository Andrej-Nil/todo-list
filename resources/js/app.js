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

    createMark = (DOMEl, classArr, value) => {
        return `
            <${DOMEl} class="${classArr.join(' ')}">${value}</${DOMEl}>
        `;
    }
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
    constructor() {
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
        this.$modalMessage = this.$modal.querySelector('#modalMessage');
        this.$spinner = this.$modal.querySelector('[data-spinner]');
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
            this.hideSpinner();
        }, 200)
    }

    showMessage = () => {
        this.$modalMessage.classList.add('open');
        this.$modalMessage.classList.add('appearance');

    }

    hideMessage = () => {
        this.$modalMessage.classList.add('open');
        setTimeout(() => {
            this.$modalMessage.classList.add('appearance');
        }, 200);
    }



    showSpinner = () => {
        this.$spinner.classList.add('show');
        this.$spinner.classList.add('appearance');
    }

    hideSpinner = () => {
        this.$spinner.classList.remove('appearance');
        setTimeout(() => {
            this.$spinner.classList.remove('show');
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
    constructor() {
        super();
        this.baseUrl = 'tasks'
    }

    get = async (taskId) => {
        const options = this.createOptions(this.POST);
        return await this.getData(`${this.baseUrl}/${taskId}`, options);
    }

    accept = async (taskId) => {
        const options = this.createOptions(this.POST);
        const url = `/${this.baseUrl}/${taskId}/accept`;
        return await this.getData(url, options);
    }

}

class TaskRender extends Render {

    getTaskHtml = (task) => {
        const {id, title, desc, status, displayBtn, info} = task;
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
        const listArr = Array(8).fill({optionalCls: 'shine', value: '&nbsp;'})
        const taskInfoList = this.getListHtml(this.getInfoEmptyItemHtml, listArr);
        return `
            <div class="task">
                <h2 class="task__title shine">&nbsp;</h2>
                <div class="task__content">
                    <p class="task__description shine">&nbsp;</p>

                    <div class="task-info">
                        <ul class="task-info__list">
                            ${taskInfoList}
                        </ul>
                    </div>
                </div>
                <div class="task__controls task__controls_empty shine"></div>
            </div>
        `
    }
    getInfoItemHtml = (item) => {
        const {label, value, url} = item;
        const infoValue = this.getInfoValueHtml(value, url);
        return `
            <li class="task-info__item">
               <span class="task-info__label">${label}</span>
                ${infoValue}
            </li>
        `;
    }

    getInfoEmptyItemHtml = (item) => {
        const {optionalCls, value} = item;
        const classes = ['task-info__item'];
        if (optionalCls) classes.push(optionalCls);
        return `<li class="${classes.join(' ')}">${value}</li>`
    }


    getInfoValueHtml = (value, url) => {
        if (url) {
            return `<a href="${url}" class="task-info__value link">${value}</a>`
        }
        return `<span class="task-info__value">${value}</span>`
    }
    getBtnHtml = (status) => {
        if (status === 0) {
            return '<button data-accept class="btn btn_blue btn_small">Приянть задачу</button>';
        }
        if (status === 1) {
            return `
                <button data-pause class="btn btn_yellow btn_small">Приостановить</button>
                <button data-complite class="btn btn_green btn_small">Выполнено</button>
            `;
        }

        if (status === 2) {
            return `
                 <button data-pause class="btn btn_yellow btn_small">Продолжить</button>
                 <button data-complite class="btn btn_green btn_small">Выполнено</button>
            `;
        }
        return '';
    }

    getErrorHtml = (errorData) => {
        const listArr = Array(8).fill({optionalCls: null, value: '&nbsp;'})
        const taskInfoList = this.getListHtml(this.getInfoEmptyItemHtml, listArr);

        return `
            <div class="task">

               <h2 class="task__title">Ошибка</h2>
               <div class="task__content">
                  <p class="task__description">${errorData.message}</p>
                    <div class="task-info">
                        <ul class="task-info__list">
                            ${taskInfoList}
                        </ul>
                    </div>
                 </div>
                 <div class="task__controls task__controls_empty"></div>
            </div>
        `;
    }

    inModal = (task) => {
        modal.clearContent();
        modal.contentRender(this.getTaskHtml, task)
    }
    errorInModal = (errorData) => {
        modal.clearContent();
        modal.contentRender(this.getErrorHtml, errorData)
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


    showTaskInModal = async ($btn) => {
        this.response = null
        modal.open(this.taskRender.getTaskSkeletonHtml);
        const taskId = $btn.dataset.showInfo;
        this.response = await this.taskService.get(taskId);
        this.responseHandler(this.taskRender.inModal, this.taskRender.errorInModal)();
    }

    acceptTask = async ($btnAccept) => {
        this.response = null;
        modal.showSpinner();
        const $task = $btnAccept.closest('[data-task-id]');
        const taskId = $task.dataset.taskId;
        this.response = await this.taskService.accept(taskId);
        this.responseHandler(this.taskRender.inModal, this.actionErrorHandler)(taskId);
    }

    actionErrorHandler = (taskId) => {
        if (this.response.data.status === 404) {


        } else {
            console.log('sdkjhvdsfghc')
            modal.showMessage();
        }
    }

    responseHandler = (successFn, errorFn) => () => {
        if (this.response.status === 'success') {
            successFn(this.response.data);
        }
        if (this.response.status === 'error') {
            errorFn(this.response.data);
        }
    };

    clickHandler = (e) => {
        if (e.target.closest('[data-accept]')) {
            this.acceptTask(e.target.closest('[data-accept]'))
        }
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
