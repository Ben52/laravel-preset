module Main exposing (Model, Msg(..), init, main, update)

import Browser exposing (Document, UrlRequest)
import Browser.Navigation exposing (Key)
import Html exposing (Html, div, text)
import Html.Attributes exposing (class)
import Json.Decode exposing (Decoder)
import Platform.Cmd exposing (Cmd)
import Url exposing (Url)
import User exposing (User(..), userDecoder)


type alias Model =
    { user : User, key : Key, token : String }


type Msg
    = UrlChanged Url
    | LinkClicked UrlRequest


init : Json.Decode.Value -> Url -> Key -> ( Model, Cmd Msg )
init flags url key =
    let
        user : User
        user =
            Json.Decode.decodeValue (Json.Decode.field "user" userDecoder) flags |> Result.withDefault Guest

        token : String
        token =
            Json.Decode.decodeValue (Json.Decode.field "token" Json.Decode.string) flags |> Result.withDefault ""
    in
    ( { user = user, key = key, token = token }
    , Cmd.none
    )


update : Msg -> Model -> ( Model, Cmd Msg )
update msg m =
    case msg of
        _ ->
            ( m, Cmd.none )


view : Model -> Document Msg
view model =
    { title = "My Elm App"
    , body =
        [ div [ class "h-screen" ]
            [ div [] [ navBar ]
            , div [ class "flex h-full items-center justify-center" ]
                [ contentView model ]
            ]
        ]
    }


contentView : Model -> Html Msg
contentView model =
    case model.user of
        Guest ->
            div [] [ text "Hello, Guest!" ]

        Authenticated { name } ->
            div [ class "text-green-light" ] [ text ("Welcome, " ++ name) ]


navBar : Html Msg
navBar =
    div [ class "w-full bg-green-lightest h-2" ] []


main =
    Browser.application
        { init = init
        , onUrlChange = UrlChanged
        , onUrlRequest = LinkClicked
        , update = update
        , subscriptions = \m -> Sub.none
        , view = view
        }
