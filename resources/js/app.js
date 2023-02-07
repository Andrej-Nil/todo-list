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
        if(e.target.closest('#userMenu')) return;
        if(e.target.closest('#userBtn') && this.$userMenu.dataset.menuStatus === 'close'){
            this.open();
            return;
        }
        if(this.$userMenu.dataset.menuStatus === 'open'){
            this.close();
            return;
        }
    }


    closeHandler = (e) => {
        // const $target = e.target;
        // if(this.$userMenu.dataset.menuStatus === 'close') return
        // if($target.closest('#menuBtn')) return
        this.close()
    }
    clickHandler = (e) => {
        if(e.target.closest('#userBtn')){
        }
        // const $target = e.target;
        // this.closeHandler($target);

    }


    listeners = () => {
        document.addEventListener('click', this.toggleMenu);
    }
}

const userMenu = new UserMenu('#userBtn', '#userMenu');
