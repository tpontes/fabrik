var FbRepeatGroup=new Class({Implements:[Options,Events],options:{repeatmin:1},initialize:function(b,a){this.element=document.id(b);this.setOptions(a);this.counter=this.getCounter();this.watchAdd();this.watchDelete()},repeatContainers:function(){return this.element.getElements(".repeatGroup")},watchAdd:function(){var a;this.element.getElement("a[data-button=addButton]").addEvent("click",function(b){b.stop();var g=this.repeatContainers().getLast();newc=this.counter+1;var f=g.id.replace("-"+this.counter,"-"+newc);var d=new Element("div",{"class":"repeatGroup",id:f}).set("html",g.innerHTML);d.inject(g,"after");this.counter=newc;if(this.counter!==0){d.getElements("input, select").each(function(h){var k=false;var e="";var j=h.id;if(h.id!==""){var c=h.id.split("-");c.pop();e=c.join("-")+"-"+this.counter;h.id=e}this.increaseName(h);$H(FabrikAdmin.model.fields).each(function(i,l){var o=false;if(typeOf(FabrikAdmin.model.fields[l][j])!=="null"){var n=FabrikAdmin.model.fields[l][j];o=Object.clone(n);try{o.cloned(e,this.counter)}catch(m){fconsole("no clone method available for "+h.id)}}if(o!==false){FabrikAdmin.model.fields[l][h.id]=o}}.bind(this))}.bind(this));d.getElements("img[src=components/com_fabrik/images/ajax-loader.gif]").each(function(h){var e=h.id.split("-");e.pop();var c=e.join("-")+"-"+this.counter+"_loader";h.id=c}.bind(this))}}.bind(this))},getCounter:function(){return this.repeatContainers().length},watchDelete:function(){this.element.getElements("a[data-button=deleteButton]").removeEvents();this.element.getElements("a[data-button=deleteButton]").each(function(b,a){b.addEvent("click",function(f){f.stop();var d=this.getCounter();if(d>this.options.repeatmin){var c=this.repeatContainers().getLast();c.destroy()}this.rename(a)}.bind(this))}.bind(this))},increaseName:function(b){var a=b.name.split("][");var c=a[2].replace("]","").toInt()+1;a.splice(2,1,c);b.name=a.join("][")+"]"},rename:function(a){this.element.getElements("input, select").each(function(b){b.name=this._decreaseName(b.name,a)}.bind(this))},_decreaseName:function(e,d){var a=e.split("][");var b=a[2].replace("]","").toInt();if(b>=1&&b>d){b--}if(a.length===3){b=b+"]"}a.splice(2,1,b);var c=a.join("][");return c}});