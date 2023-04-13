// This function generates a random string which is used for the order_id.
function randomString(length) {
    return Math.round(
      Math.pow(36, length + 1) - Math.random() * Math.pow(36, length)
    )
      .toString(36)
      .slice(1);
  }

  module.exports=randomString;