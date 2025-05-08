const editors = document.querySelectorAll(".cke");
editors.forEach((editor) => {
  ClassicEditor.create(editor).catch((error) => {
    console.error(error);
  });
});
