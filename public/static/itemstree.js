
    window.clickedElement = 'free'; //container for element in progress
    window.mouseButtom = {'left' : 1, 'right': 3 }

    window.onload = function()
    {
        document.oncontextmenu = function() {return false;}; //disable context menu on right click

        jQuery('#items_tree').delegate('li', 'mousedown',function(event){

            event.stopPropagation();
            // there is element in process
            if(clickedElement !== 'free'){
                return
            }
            clickedElement = this;
            //element is opened so close it
            if(isElementOpen(this)){
                removeChildItems(this);
            }//rigth click opent all the tree
            else if(event.which == mouseButtom.right){
                getChildItems();
            }
            else{//opent next level
                var depth = 1;
                getChildItems(depth);   
            }
        })
    }

    window.isElementOpen = function(element)
    {
        if(element.childNodes[1]){ // 1 - is not text node but next
            return element.childNodes[1].nodeName === 'UL';
        }

        return false;
    }

    window.removeChildItems = function(clickedElement)
    {
        if(window.clickedElement.childNodes[1]){
            window.clickedElement.removeChild(clickedElement.childNodes[1]);
        }
        window.clickedElement = 'free'; 
    }

    window.getChildItems = function(depth)
    {
        if( ! depth){
            depth = 0;
        }
        var url = 'index.php?itemId=' + clickedElement.id + '&depth=' + depth;

        var request = new XMLHttpRequest();
        request.open("GET", url, true);
        request.setRequestHeader('X-Requested-With','XMLHttpRequest');

        request.onreadystatechange = function()
        {
            if(request.readyState == 4)
            {
                if(request.status == 200)
                {
                    children = JSON.parse(request.responseText);
                    window.appendChildrenToItem(children);
                }
                else
                    console.log('ajax request failed') ;
            }
        } ;
        request.send(null) ;
    }

    window.appendChildrenToItem = function(children)
    {
        try{
            var ul = bildDomTree(children);
            clickedElement.appendChild(ul);
        }
        catch(error){}

        window.clickedElement = 'free'; 
    }

    window.bildDomTree = function(children)
    {
        var ul = document.createElement("ul");
        var lastItemLevel = children[0].level;
        var currentUl = ul;

        for (var i = 0; i < children.length ; i++) {

            if(children[i].level > lastItemLevel){
                var newUl = document.createElement("ul");
                currentUl.lastChild.appendChild(newUl);
                currentUl = currentUl.lastChild.lastChild;
            }
            else if(children[i].level < lastItemLevel){
                var levelDifference = lastItemLevel - children[i].level;
                for (var j = 0; j < levelDifference ; j++){
                    try{
                        currentUl = currentUl["parentNode"]["parentNode"];
                    }
                    catch(error){
                        currentUl = ul;
                        break;   
                    }

                }
                
            }
            
            var li = document.createElement("li");
            var text = children[i].name + ' (' + children[i].children_count + ')';
            li.appendChild(document.createTextNode(text));
            li.setAttribute("id",children[i].id);
            currentUl.appendChild(li);

            lastItemLevel = children[i].level;
        };

        return ul;
    }