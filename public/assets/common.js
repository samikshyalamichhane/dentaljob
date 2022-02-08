function loadImage() {
    const allImagesInput = [...document.querySelectorAll(".fileUpload")];
    allImagesInput.forEach((input) => {
        console.log(input);
        let imageHolder = $(input)
            .next("div.wrapper")
            .children(".image-holder");
        console.log(imageHolder);
        $(input).on("change", function () {
            if (typeof FileReader != "undefined") {
                var image_holder = $(imageHolder);

                // $("#image-holder").siblings().remove();
                $(imageHolder).children().remove();
                var reader = new FileReader();
                reader.onload = function (e) {
                    $("<img />", {
                        src: e.target.result,
                        class: "thumb-image my-2",
                        style:
                            "border: 1px solid #ccc;padding: 13px;border-radius: 10px;",
                        width: "50%",
                    }).appendTo(image_holder);
                };
                image_holder.show();
                reader.readAsDataURL($(this)[0].files[0]);
            } else {
                alert("This browser does not support FileReader.");
            }
        });
    });
}
