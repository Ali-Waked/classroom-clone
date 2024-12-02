  import EditorJS from '@editorjs/editorjs';
  import Header from '@editorjs/header';
  import Quote from '@editorjs/quote';
function editorActive() {
  const editor = new EditorJS({
    holder: 'editorjs',
    tools: {
        header: {
            class: Header,
            config: {
              placeholder: 'Enter a header',
              levels: [2, 3, 4],
              defaultLevel: 3
            }
          },
        list: {
          class: List,
          inlineToolbar: true,
          config: {
            defaultStyle: 'unordered'
          }
        },
      },
});
// document.addEventListener('DOMContentLoaded', function () {
    // document.getElementsByClassName('codex-editor__redactor')[0].style.padding = '0';
    setTimeout(() => {
        document.getElementById('editorjs').onclick = function() {
            this.classList.add('active');
        }
        document.getElementById('send_classwork').onclick = async function (e) {
            e.preventDefault();
            const form = document.getElementById('classwork-form');
            await editor.save().then((outputData) => {
                const contentInput = document.createElement('input');
                contentInput.setAttribute('type', 'hidden');
                contentInput.setAttribute('name', 'description');
                contentInput.value = JSON.stringify(outputData);
                form.appendChild(contentInput);
                form.submit();
            }).catch((error) => {
                console.log(error);
            });
        }
    }, 500);
// })
}
  document.getElementById('create-classwork-assignment').onclick  = function ()  {
    editorActive();
  }
  document.getElementById('create-classwork-question').onclick  = function ()  {
    editorActive();
  }
  document.getElementById('create-classwork-material').onclick  = function ()  {
    editorActive();
  }
  const elements = document.querySelectorAll("a.edit-classwork");
  for(let i=0; i< elements.length; i++) {
  elements[i].onclick =  function () {
    setTimeout(async () => {
      editorActive();
      if(elements[i].dataset.description){
        const editor = new EditorJS({
          holder: 'editorjs',
          tools: {
              header: {
                  class: Header,
                  config: {
                    placeholder: 'Enter a header',
                    levels: [2, 3, 4],
                    defaultLevel: 3
                  }
                },
              list: {
                class: List,
                inlineToolbar: true,
                config: {
                  defaultStyle: 'unordered'
                }
              },
            },
      });
      // const editor = new EditorJS();
      console.log(editor.blocks = JSON.parse(elements[i].dataset.description).blocks);
      // editor.blocks.insert('header', {text: 'My header'});
      console.log(JSON.parse(elements[i].dataset.description).blocks)
     
  // const paragraphBlock = savedData.blocks[0];

  // paragraphBlock.data.text += ' ' + appendedText;

  // editor.render({ blocks: savedData.blocks });
      }
    }, 0);
  }}