import json

from flask import Flask, request, Response

from extensions import mongo, mail
from models.pisado import Pisado
from utils.exceptions import NameFieldsException, TypeFieldsException

app = Flask(__name__)
app.config.from_pyfile('config.cfg')

mongo.app = app
mongo.init_app(app)
mail.app = app
mail.init_app(app)


@app.route('/pisado', methods=['POST'])
def create_pisado():
    try:
        pisado = Pisado(request.json)
        pisado.save()
        return Response(response=json.dumps(pisado.serialize()),
                        status=201,
                        mimetype="application/json")
    except NameFieldsException as e:
        return Response(response=json.dumps({"error": "Faltan los siguientes campos: " + e.error_field}),
                        status=400,
                        mimetype="application/json")
    except TypeFieldsException as e:
        return Response(response=json.dumps(
            {"error": "Los siguiente campos son de tipo incorrecto: {}. Deben ser de tipo {}".format(
                e.error_field, e.error_type)}),
                        status=400,
                        mimetype="application/json")


if __name__ == '__main__':
    app.run()
