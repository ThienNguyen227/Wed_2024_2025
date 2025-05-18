/**
 * This configuration was generated using the CKEditor 5 Builder. You can modify it anytime using this link:
 * https://ckeditor.com/ckeditor-5/builder/?redirect=portal#installation/NoFgNARATAdAbDADBSBGEiDMcCcisCsImqAHAQOyYWm5yJQGkgg2pEFyampSkoQApgDsUiMMFRhx4qbIC6aRAQAmAMyiCI8oA===
 */

const {
  ClassicEditor,
  Autoformat,
  AutoImage,
  AutoLink,
  Autosave,
  Bold,
  CKBox,
  CKBoxImageEdit,
  CloudServices,
  Code,
  CodeBlock,
  Emoji,
  Essentials,
  GeneralHtmlSupport,
  Heading,
  HtmlComment,
  HtmlEmbed,
  ImageBlock,
  ImageCaption,
  ImageInline,
  ImageInsert,
  ImageInsertViaUrl,
  ImageResize,
  ImageStyle,
  ImageTextAlternative,
  ImageToolbar,
  ImageUpload,
  Italic,
  Link,
  LinkImage,
  List,
  ListProperties,
  Mention,
  Paragraph,
  PasteFromOffice,
  PictureEditing,
  ShowBlocks,
  Table,
  TableCaption,
  TableCellProperties,
  TableColumnResize,
  TableProperties,
  TableToolbar,
  TextTransformation,
} = window.CKEDITOR;
const { PasteFromOfficeEnhanced, SourceEditingEnhanced } =
  window.CKEDITOR_PREMIUM_FEATURES;

const LICENSE_KEY =
  "eyJhbGciOiJFUzI1NiJ9.eyJleHAiOjE3NDg3MzU5OTksImp0aSI6IjY3ZjA4ZmNkLTAxMzgtNGIwMi1hNGQ5LTJjZDM0ZmE3NzkxNSIsInVzYWdlRW5kcG9pbnQiOiJodHRwczovL3Byb3h5LWV2ZW50LmNrZWRpdG9yLmNvbSIsImRpc3RyaWJ1dGlvbkNoYW5uZWwiOlsiY2xvdWQiLCJkcnVwYWwiLCJzaCJdLCJ3aGl0ZUxhYmVsIjp0cnVlLCJsaWNlbnNlVHlwZSI6InRyaWFsIiwiZmVhdHVyZXMiOlsiKiJdLCJ2YyI6ImNiMTFmNTE2In0.KLnf5qmve5tvGWH3GBVlY3JI4EYIP1FwF8oBeys2sVMohRMWyptdWfjgjw2pmPXUgHQLGI1Gfj5XjFKXu-oCtg";

const CLOUD_SERVICES_TOKEN_URL =
  "https://lobgzacfm0rx.cke-cs.com/token/dev/6f1ee0e853f997ebadba9b3953fb699a1badd65ca616c7278c9307a2661e?limit=10";

const editorConfig = {
  toolbar: {
    items: [
      "undo",
      "redo",
      "|",
      "sourceEditingEnhanced",
      "showBlocks",
      "|",
      "heading",
      "|",
      "bold",
      "italic",
      "code",
      "|",
      "emoji",
      "link",
      "insertImage",
      "ckbox",
      "insertTable",
      "codeBlock",
      "htmlEmbed",
      "|",
      "bulletedList",
      "numberedList",
    ],
    shouldNotGroupWhenFull: false,
  },
  plugins: [
    Autoformat,
    AutoImage,
    AutoLink,
    Autosave,
    Bold,
    CKBox,
    CKBoxImageEdit,
    CloudServices,
    Code,
    CodeBlock,
    Emoji,
    Essentials,
    GeneralHtmlSupport,
    Heading,
    HtmlComment,
    HtmlEmbed,
    ImageBlock,
    ImageCaption,
    ImageInline,
    ImageInsert,
    ImageInsertViaUrl,
    ImageResize,
    ImageStyle,
    ImageTextAlternative,
    ImageToolbar,
    ImageUpload,
    Italic,
    Link,
    LinkImage,
    List,
    ListProperties,
    Mention,
    Paragraph,
    PasteFromOffice,
    PasteFromOfficeEnhanced,
    PictureEditing,
    ShowBlocks,
    SourceEditingEnhanced,
    Table,
    TableCaption,
    TableCellProperties,
    TableColumnResize,
    TableProperties,
    TableToolbar,
    TextTransformation,
  ],
  cloudServices: {
    tokenUrl: CLOUD_SERVICES_TOKEN_URL,
  },
  heading: {
    options: [
      {
        model: "paragraph",
        title: "Paragraph",
        class: "ck-heading_paragraph",
      },
      {
        model: "heading1",
        view: "h1",
        title: "Heading 1",
        class: "ck-heading_heading1",
      },
      {
        model: "heading2",
        view: "h2",
        title: "Heading 2",
        class: "ck-heading_heading2",
      },
      {
        model: "heading3",
        view: "h3",
        title: "Heading 3",
        class: "ck-heading_heading3",
      },
      {
        model: "heading4",
        view: "h4",
        title: "Heading 4",
        class: "ck-heading_heading4",
      },
      {
        model: "heading5",
        view: "h5",
        title: "Heading 5",
        class: "ck-heading_heading5",
      },
      {
        model: "heading6",
        view: "h6",
        title: "Heading 6",
        class: "ck-heading_heading6",
      },
    ],
  },
  htmlSupport: {
    allow: [
      {
        name: /^.*$/,
        styles: true,
        attributes: true,
        classes: true,
      },
    ],
  },
  image: {
    toolbar: [
      "toggleImageCaption",
      "imageTextAlternative",
      "|",
      "imageStyle:inline",
      "imageStyle:wrapText",
      "imageStyle:breakText",
      "|",
      "resizeImage",
      "|",
      "ckboxImageEdit",
    ],
  },
  licenseKey: LICENSE_KEY,
  link: {
    addTargetToExternalLinks: true,
    defaultProtocol: "https://",
    decorators: {
      toggleDownloadable: {
        mode: "manual",
        label: "Downloadable",
        attributes: {
          download: "file",
        },
      },
    },
  },
  list: {
    properties: {
      styles: true,
      startIndex: true,
      reversed: true,
    },
  },
  mention: {
    feeds: [
      {
        marker: "@",
        feed: [
          /* See: https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html */
        ],
      },
    ],
  },
  placeholder: "Nhập nội dung mô tả sản phẩm ...",
  table: {
    contentToolbar: [
      "tableColumn",
      "tableRow",
      "mergeTableCells",
      "tableProperties",
      "tableCellProperties",
    ],
  },
};

configUpdateAlert(editorConfig);

const editorInstances = [];

document.querySelectorAll(".editor").forEach((element) => {
  ClassicEditor.create(element, editorConfig)
    .then((editor) => {
      editorInstances.push(editor);
    })
    .catch((error) => {
      console.error("CKEditor init failed: ", error);
    });
});

// Đồng bộ dữ liệu CKEditor với textarea trước khi gửi form
document.querySelectorAll("form").forEach((form) => {
  form.addEventListener("submit", () => {
    editorInstances.forEach((editor) => {
      editor.updateSourceElement();
    });
  });
});

/**
 * This function exists to remind you to update the config needed for premium features.
 * The function can be safely removed. Make sure to also remove call to this function when doing so.
 */
function configUpdateAlert(config) {
  if (configUpdateAlert.configUpdateAlertShown) {
    return;
  }

  const isModifiedByUser = (currentValue, forbiddenValue) => {
    if (currentValue === forbiddenValue) {
      return false;
    }

    if (currentValue === undefined) {
      return false;
    }

    return true;
  };

  const valuesToUpdate = [];

  configUpdateAlert.configUpdateAlertShown = true;

  if (!isModifiedByUser(config.licenseKey, "<YOUR_LICENSE_KEY>")) {
    valuesToUpdate.push("LICENSE_KEY");
  }

  if (
    !isModifiedByUser(
      config.cloudServices?.tokenUrl,
      "<YOUR_CLOUD_SERVICES_TOKEN_URL>"
    )
  ) {
    valuesToUpdate.push("CLOUD_SERVICES_TOKEN_URL");
  }

  if (valuesToUpdate.length) {
    window.alert(
      [
        "Please update the following values in your editor config",
        "to receive full access to Premium Features:",
        "",
        ...valuesToUpdate.map((value) => ` - ${value}`),
      ].join("\n")
    );
  }
}
