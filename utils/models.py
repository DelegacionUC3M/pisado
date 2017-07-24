import datetime

from utils.exceptions import NameFieldsException, TypeFieldsException


def validate_model(data, model):
    for field in model:
        if not field.get("nullable"):
            if not field.get("name") in data.keys():
                raise NameFieldsException(field.get("name"))
            value = data.get(field.get("name"))
            if not field.get("type") is str:
                try:
                    value = field.get("type")(value)
                except ValueError:
                    raise TypeFieldsException(error_field=field.get("name"), error_type=field.get("type"))
            if not isinstance(value, field.get("type")):
                raise TypeFieldsException(error_field=field.get("name"), error_type=field.get("type"))


def get_data_from_model(data, model):
    validate_model(data, model)

    result = {}
    for field in model:
        if field.get("nullable") and not field.get("name") in data.keys():
            default = field.get("default")() if callable(field.get("default")) else field.get("default")
            result.update({field.get("name"): default})
        else:
            if field.get("type") is datetime.datetime:
                result.update({field.get("name"): datetime.datetime.strptime(data.get(field.get("name")),
                                                                             "%Y-%m-%d %H:%M:%S")})
            else:
                result.update({field.get("name"): field.get("type")(data.get(field.get("name")))})

    return result
