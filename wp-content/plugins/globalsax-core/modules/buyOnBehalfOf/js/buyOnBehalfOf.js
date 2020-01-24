

class BuyOnBehalfOfModule{


  constructor(){
    this.root = document.getElementById('page');

    this.bar = document.getElementById('buyOnBehalfOf');

    if (typeof(this.bar) == 'undefined' || this.bar == null){
      this.bar = document.createElement('div');
      this.bar.id = 'buyOnBehalfOf';
      this.root.prepend(this.bar);
    }
  }

  check(){
    return this.root;
  }

}

const bobo = new BuyOnBehalfOfModule();
console.log(bobo.check());
