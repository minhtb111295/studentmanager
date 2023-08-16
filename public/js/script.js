// Pagination
function goToPage(page) {
  const currentURL = window.location.href;
  const objURL = new URL(currentURL);
  objURL.searchParams.set("page", page);
  const newURL = objURL.href;
  window.location.href = newURL;
}

// Get URL for Modal Delete
$("button.delete").click(function (e) {
  $dataHref = $(this).attr("data-href");
  $("#exampleModal a").attr("href", $dataHref);
});

// Validation Student Form
$(".student-create-validate, .student-edit-validate").validate({
  rules: {
    name: {
      required: true,
      regex:
        /^[a-zA-ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s]+$/i,
      minlength: 2,
      maxlength: 30,
    },
    birthday: {
      required: true,
    },
    gender: {
      required: true,
    },
  },
  messages: {
    name: {
      required: "Tên sinh viên không được bỏ trống",
      regex: "Định dạng tên không hợp lệ",
      minlength: "Tên quá ngắn (tối thiểu 2 kí tự)!",
      maxlength: "Tên quá dài (tối đa 30 kí tự)!",
    },
    birthday: {
      required: "Vui lòng chọn ngày sinh",
    },
    gender: {
      required: "Vui lòng chọn giới tính",
    },
  },
});

// Validation Subject Form
$(".subject-create-validate, .subject-edit-validate").validate({
  rules: {
    name: {
      required: true,
      regex:
        /^[a-zA-ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s]+$/i,
      minlength: 2,
      maxlength: 30,
    },
    ects: {
      required: true,
      digits: true,
      range: [5, 30],
    },
  },
  messages: {
    name: {
      required: "Tên môn học không được bỏ trống",
      regex: "Định dạng tên không hợp lệ",
      minlength: "Tên quá ngắn (tối thiểu 2 kí tự)!",
      maxlength: "Tên quá dài (tối đa 30 kí tự)!",
    },
    ects: {
      required: "Số tín chỉ không được bỏ trống",
      digits: "Vui lòng nhập đúng định dạng (số nguyên)!",
      range: "Số tín chỉ phải từ 5 đến 30",
    },
  },
});

// Validation Register Form
$(".register-create-validate").validate({
  rules: {
    student_id: {
      required: true,
    },
    subject_id: {
      required: true,
    },
  },
  messages: {
    student_id: {
      required: "Vui lòng chọn sinh viên",
    },
    subject_id: {
      required: "Vui lòng chọn môn học",
    },
  },
});

$(".register-edit-validate").validate({
  rules: {
    score: {
      required: true,
      digits: true,
      range: [0, 10],
    },
  },
  messages: {
    score: {
      required: "Vui lòng nhập điểm",
      digits: "Điểm phải là số nguyên!",
      range: "Điểm không hợp lệ (từ 0 đến 10)",
    },
  },
});

// Regex
$.validator.addMethod(
  "regex",
  function (value, element, regexp) {
    var re = new RegExp(regexp);
    return this.optional(element) || re.test(value);
  },
  "Please check your input."
);
